<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ColorValidator extends ConstraintValidator {

    static string $ColorRegexp = '/^#([A-Fa-f0-9]){6}$/';

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint): void {
        if(!$constraint instanceof Color) {
            throw new UnexpectedTypeException($constraint, Color::class);
        }

        if(!empty($value) && !preg_match(self::$ColorRegexp, $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}