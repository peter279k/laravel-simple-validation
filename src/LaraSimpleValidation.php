<?php

namespace Lee\LaraSimpleValidation;

use Illuminate\Contracts\Validation\Rule;

class LaraSimpleValidation implements Rule
{
    protected $attribute;

    protected $messageFormat;

    protected $ruleName = 'validation.rule.name';

    protected $ruleMessage = 'validation.rule.message';

    protected $validationType;

    protected $validLength;

    public function passes($attribute, $value)
    {
        if ($this->validationType === 'string') {
            return $this->isString($value);
        }

        if ($this->validationType === 'email') {
            return $this->isEmailFormat($value);
        }

        if ($this->validationType === 'ip') {
            return $this->isIpFormat($value);
        }

        if ($this->validationType === 'length') {
            return $this->isValidLength($value);
        }

        return false;
    }

    public function message()
    {
        trans($this->messageFormat[$this->ruleName]) != $this->messageFormat[$this->ruleName] ? trans($this->messageFormat[$this->ruleName]) : $this->messageFormat[$this->ruleMessage];
    }

    private function isString($value)
    {
        return is_string($value);
    }

    private function isEmailFormat($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isIpFormat($value)
    {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    private function isValidLength($value, $validLength = null)
    {
        $validLength = $validLength ?? mb_strlen($value);

        return mb_strlen($value) === $validLength;
    }

    public function setMessageFormat(array $messageFormat)
    {
        if (!array_key_exists($this->ruleName, $messageFormat)) {
            throw new \InvalidArgumentException($this->ruleName . ' key is missed');
        }

        if (!array_key_exists($this->ruleMessage, $messageFormat)) {
            throw new \InvalidArgumentException($this->ruleMessage . ' key is missed');
        }

        $this->messageFormat = $messageFormat;
    }

    public function getMessageFormat()
    {
        return $this->messageFormat;
    }

    public function setValidationType(string $validationType)
    {
        $this->validationType = $validationType;
    }

    public function getValidationType()
    {
        return $this->validationType;
    }

    public function setValidationLength($validLength)
    {
        $this->validLength = $validLength;
    }
}
