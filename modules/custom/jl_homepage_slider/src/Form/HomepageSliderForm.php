<?php

namespace Drupal\jl_homepage_slider\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Configure homepage slider images - UNLIMITED slides + Hide dots option!
 */
class HomepageSliderForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'jl_homepage_slider_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jl_homepage_slider.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('jl_homepage_slider.settings');

    // Get number of slides (default 5, but can be unlimited!)
    $num_slides = $config->get('num_slides') ?: 5;

    // Easy-to-understand instructions
    $form['instructions'] = [
      '#type' => 'markup',
      '#markup' => '
        <div style="background: #d4edda; padding: 20px; border-radius: 8px; margin-bottom: 30px; border-left: 5px solid #28a745;">
          <h2 style="margin-top: 0; color: #155724;">📸 How to Update Your Homepage Slider</h2>
          <ol style="font-size: 16px; line-height: 1.8;">
            <li><strong>Click "Choose File"</strong> next to each slide number below</li>
            <li><strong>Select an image</strong> from your computer (JPG, PNG, or GIF)</li>
            <li><strong>Click "Upload"</strong> to upload the image</li>
            <li><strong>Need more slides?</strong> Click "Add More Slides" button at bottom</li>
            <li><strong>Click "Save configuration"</strong> when done</li>
          </ol>
          <p style="margin-bottom: 0;"><strong>💡 New Features:</strong></p>
          <ul style="margin-top: 5px;">
            <li>✨ <strong>UNLIMITED slides</strong> - Add as many as you want!</li>
            <li>👁️ <strong>Hide navigation dots</strong> - Check the box below for cleaner look</li>
            <li>Best image size: <strong>1920 x 1080 pixels</strong> (or similar ratio)</li>
            <li>To remove an image: Click "Remove" next to it, then save</li>
          </ul>
        </div>
      ',
    ];

    // Settings section
    $form['settings'] = [
      '#type' => 'details',
      '#title' => '⚙️ Slider Settings',
      '#open' => TRUE,
    ];

    $form['settings']['hide_dots'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Navigation Dots'),
      '#description' => $this->t('Check this box to hide the navigation dots at the bottom of the slider'),
      '#default_value' => $config->get('hide_dots') ?: 0,
    ];

    $form['settings']['num_slides_display'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>Current number of slides: ' . $num_slides . '</strong></p>',
    ];

    // Create slide upload fields dynamically
    for ($i = 1; $i <= $num_slides; $i++) {
      $form["slide_$i"] = [
        '#type' => 'details',
        '#title' => "🖼️ Slide $i",
        '#open' => $config->get("slide_$i") ? FALSE : ($i == 1 ? TRUE : FALSE),
      ];

      $form["slide_$i"]["slide_{$i}_upload"] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Image for Slide @num', ['@num' => $i]),
        '#upload_location' => 'public://homepage-slider/',
        '#upload_validators' => [
          'file_validate_extensions' => ['jpg jpeg png gif webp'],
          'file_validate_size' => [10 * 1024 * 1024], // 10MB max
        ],
        '#default_value' => $config->get("slide_$i") ? [$config->get("slide_$i")] : [],
        '#description' => $this->t('Click "Choose File" to select an image from your computer'),
      ];

      // Show preview if image exists
      $fid = $config->get("slide_$i");
      if ($fid) {
        $file = File::load($fid);
        if ($file) {
          $url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
          $form["slide_$i"]["preview_$i"] = [
            '#type' => 'markup',
            '#markup' => '
              <div style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <strong>Current Image:</strong><br>
                <img src="' . $url . '" style="max-width: 400px; height: auto; margin-top: 10px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" alt="Slide ' . $i . ' preview">
              </div>
            ',
          ];
        }
      }
    }

    // Add more slides section
    $form['add_more'] = [
      '#type' => 'details',
      '#title' => '➕ Add More Slides',
      '#open' => TRUE,
    ];

    $form['add_more']['add_count'] = [
      '#type' => 'number',
      '#title' => $this->t('How many slides to add?'),
      '#default_value' => 1,
      '#min' => 1,
      '#max' => 20,
      '#description' => $this->t('Enter number of additional slides to add (1-20 at a time)'),
    ];

    $form['add_more']['add_slides_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add More Slides'),
      '#submit' => ['::addMoreSlides'],
      '#attributes' => [
        'style' => 'background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;',
      ],
    ];

    // Show all current slides at the top
    $current_slides_html = $this->getCurrentSlidesPreview($config, $num_slides);
    if ($current_slides_html) {
      $form['current_slides'] = [
        '#type' => 'markup',
        '#markup' => $current_slides_html,
        '#weight' => -10,
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * Submit handler for adding more slides.
   */
  public function addMoreSlides(array &$form, FormStateInterface $form_state) {
    $config = $this->config('jl_homepage_slider.settings');
    $num_slides = $config->get('num_slides') ?: 5;
    $add_count = $form_state->getValue('add_count') ?: 1;
    
    $num_slides += $add_count;
    $config->set('num_slides', $num_slides)->save();
    
    $this->messenger()->addStatus($this->t('✅ Added @count new slide slots! Total slides: @total. Upload images and save configuration.', [
      '@count' => $add_count,
      '@total' => $num_slides,
    ]));
    
    $form_state->setRebuild();
  }

  /**
   * Generate preview of all current slides.
   */
  private function getCurrentSlidesPreview($config, $num_slides) {
    $slides_exist = FALSE;
    $preview_html = '
      <div style="background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 2px solid #007bff;">
        <h3 style="margin-top: 0; color: #007bff;">👁️ Current Homepage Slider Images (' . $num_slides . ' total slides)</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 15px;">
    ';
    
    for ($i = 1; $i <= $num_slides; $i++) {
      $fid = $config->get("slide_$i");
      if ($fid) {
        $slides_exist = TRUE;
        $file = File::load($fid);
        if ($file) {
          $url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
          $preview_html .= '
            <div style="border: 2px solid #e0e0e0; padding: 15px; border-radius: 8px; background: #f8f9fa;">
              <strong style="color: #495057;">Slide ' . $i . '</strong><br>
              <img src="' . $url . '" style="width: 100%; height: auto; border-radius: 6px; margin-top: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);" alt="Slide ' . $i . '">
            </div>
          ';
        }
      }
    }
    
    $preview_html .= '</div></div>';
    
    return $slides_exist ? $preview_html : '';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Don't save if "Add More Slides" was clicked
    if ($form_state->getTriggeringElement()['#value'] == $this->t('Add More Slides')) {
      return;
    }

    $config = $this->config('jl_homepage_slider.settings');

    // Save hide dots setting
    $config->set('hide_dots', $form_state->getValue('hide_dots'));

    // Get current number of slides
    $num_slides = $config->get('num_slides') ?: 5;

    // Save each slide image
    for ($i = 1; $i <= $num_slides; $i++) {
      $file_id = $form_state->getValue("slide_{$i}_upload");
      
      if (!empty($file_id)) {
        $file_id = reset($file_id);
        $file = File::load($file_id);
        
        if ($file) {
          // Make the file permanent
          $file->setPermanent();
          $file->save();
          
          // Save file ID to configuration
          $config->set("slide_$i", $file_id);
        }
      }
      elseif ($form_state->getValue("slide_{$i}_upload") === []) {
        // User removed the image
        $config->set("slide_$i", NULL);
      }
    }

    $config->save();
    
    // Show success message
    $hide_dots_status = $config->get('hide_dots') ? 'hidden' : 'visible';
    $this->messenger()->addStatus($this->t('✅ Homepage slider saved! Slides: @count | Navigation dots: @dots | Visit your homepage to see changes.', [
      '@count' => $num_slides,
      '@dots' => $hide_dots_status,
    ]));
    
    parent::submitForm($form, $form_state);
  }

}
