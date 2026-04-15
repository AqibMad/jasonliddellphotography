<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/jasonlidbell_theme/templates/page--front.html.twig */
class __TwigTemplate_6e08c039a600ff874e2ebd778203e27d extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 8
        yield "<div class=\"container\">
  ";
        // line 10
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 10), "html", null, true);
        yield "

  ";
        // line 13
        yield "  <div class=\"slider-container\">
    <div class=\"slider\" id=\"slider\">
      ";
        // line 16
        yield "      ";
        if ((($context["slider_images"] ?? null) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["slider_images"] ?? null)) > 0))) {
            // line 17
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["slider_images"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 18
                yield "          <div class=\"slide ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, true, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : ("")));
                yield "\" style=\"background-image: url('";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["image"], "url", [], "any", false, false, true, 18), "html", null, true);
                yield "');\"></div>
        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            yield "      ";
        } else {
            // line 21
            yield "        ";
            // line 22
            yield "        <div class=\"slide active\" style=\"background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=80');\"></div>
        <div class=\"slide\" style=\"background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920&q=80');\"></div>
        <div class=\"slide\" style=\"background-image: url('https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?w=1920&q=80');\"></div>
        <div class=\"slide\" style=\"background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920&q=80');\"></div>
        <div class=\"slide\" style=\"background-image: url('https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=1920&q=80');\"></div>
      ";
        }
        // line 28
        yield "    </div>
    
    <div class=\"slider-overlay\"></div>
    
    ";
        // line 33
        yield "    ";
        if ((($tmp =  !($context["hide_slider_dots"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 34
            yield "      <div class=\"slider-dots\" id=\"sliderDots\">
        ";
            // line 35
            $context["slide_count"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["slider_images"] ?? null)) > 0)) ? (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["slider_images"] ?? null))) : (5));
            // line 36
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(0, (($context["slide_count"] ?? null) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 37
                yield "          <div class=\"dot ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((($context["i"] == 0)) ? ("active") : ("")));
                yield "\" data-slide=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["i"], "html", null, true);
                yield "\"></div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            yield "      </div>
    ";
        }
        // line 41
        yield "  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "slider_images", "loop", "hide_slider_dots"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/jasonlidbell_theme/templates/page--front.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  144 => 41,  140 => 39,  129 => 37,  124 => 36,  122 => 35,  119 => 34,  116 => 33,  110 => 28,  102 => 22,  100 => 21,  97 => 20,  78 => 18,  60 => 17,  57 => 16,  53 => 13,  47 => 10,  44 => 8,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/jasonlidbell_theme/templates/page--front.html.twig", "D:\\xampp\\htdocs\\jasonliddellphotography\\themes\\custom\\jasonlidbell_theme\\templates\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 16, "for" => 17, "set" => 35];
        static $filters = ["escape" => 10, "length" => 16];
        static $functions = ["range" => 36];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'length'],
                ['range'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
