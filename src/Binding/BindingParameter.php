<?php

/*
 * This file is part of the puli/discovery package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Puli\Discovery\Binding;

use Assert\Assertion;
use RuntimeException;

/**
 * A parameter that can be set during binding.
 *
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class BindingParameter
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var mixed
     */
    private $defaultValue;

    /**
     * Creates a new parameter.
     *
     * @param string $name         The parameter name.
     * @param bool   $required     Whether the parameter is required.
     * @param mixed  $defaultValue The parameter's default value.
     */
    public function __construct($name, $required = false, $defaultValue = null)
    {
        Assertion::string($name, 'The parameter name must be a string. Got: %2$s');
        Assertion::notEmpty($name, 'The parameter name must not be empty.');
        Assertion::alnum($name, 'The parameter name must contain letters and digits only and start with a letter.');
        Assertion::boolean($required, 'The parameter "$required" must be a boolean. Got: %s');

        if ($required && null !== $defaultValue) {
            throw new RuntimeException('Required parameters must not have default values.');
        }


        $this->name = $name;
        $this->required = $required;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Returns the name of the parameter.
     *
     * @return string The parameter name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns whether the parameter must be set.
     *
     * This method is the inverse of {@link isOptional()}.
     *
     * @return bool Returns `true` if the parameter must be set.
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * Returns whether the parameter is optional.
     *
     * This method is the inverse of {@link isRequired()}.
     *
     * @return bool Returns `true` if the parameter is optional.
     */
    public function isOptional()
    {
        return !$this->required;
    }

    /**
     * Returns the default value of the parameter.
     *
     * @return mixed The default value.
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }
}
