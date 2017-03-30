<?php
namespace Mirasvit\Profiler\Block;

use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Framework\View\Element\Template;

class Container extends Template
{
    /**
     * @var string
     */
    protected $_template = 'container.phtml';

    /**
     * @var array
     */
    protected $tabs = [];

    /**
     * @var TemplateContext
     */
    protected $context;

    public function __construct(
        TemplateContext $templateContext,
        Context $context,
        array $data = [],
        array $tabs = []
    ) {
        $this->context = $context;
        $this->tabs = $tabs;

        parent::__construct($templateContext, $data);
    }

    /**
     * @return Tab\TabInterface[]
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @return float
     */
    public function getRequestTime()
    {
        return microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    }

    /**
     * @return int
     */
    public function getDbTotalNumQueries()
    {
        return $this->context->getDbProfiler()->getTotalNumQueries();
    }

    /**
     * @return int
     */
    public function getDbTotalElapsedSecs()
    {
        return $this->context->getDbProfiler()->getTotalElapsedSecs();
    }

    /**
     * @return string
     */
    public function getStyles()
    {
        $file = dirname(dirname(__FILE__)) . '/view/base/web/css/module.css';

        return file_get_contents($file);
    }
}