<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @see       https://github.com/zendframework/zend-expressive for the canonical source repository
 * @copyright Copyright (c) 2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Expressive\Template;


trait AddParametersTrait
{
    /**
     * @var array
     */
    protected $templateParams = [];

    /**
     * Add parameters to template
     *
     * If no template name is given, the parameters will be added to all templates rendered
     *
     * @param array|object $params
     * @param string $name
     */
    public function addParameters($params, $name = null)
    {
        if (method_exists($this, 'normalizeParams')) {
            $params = $this->normalizeParams($params);
        }
        $name = (string) $name;
        $existing = isset($this->templateParams[$name]) ? $this->templateParams[$name] : null;
        $this->templateParams[$name] = array_merge($existing, $params, $name);
    }

    /**
     * Returns merged global, template-specific and given params
     *
     * @param array $params
     * @param string $name
     * @return array
     */
    protected function mergeParams($params, $name)
    {
        return array_merge(
            isset($this->templateParams['']) ? $this->templateParams[''] : [],
            isset($this->templateParams[$name]) ? $this->templateParams[$name] : [],
            $params
        );
    }
}