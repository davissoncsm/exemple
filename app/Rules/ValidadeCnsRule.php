<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidadeCnsRule implements ValidationRule
{
    private string $pis;

    private string $cns;

    private string $result;

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->clearCns(cns: $value);

        if (strlen($this->cns) !== 15) {
            $fail('The :attribute is incorrect.');
        }

        $this->setPis();

        if ($this->cns[0] == 1 || $this->cns[0] == 2) {
            $this->validateCnsStarted1or2($fail);
        }

        if ($this->cns[0] == 7 || $this->cns[0] == 8 || $this->cns[0] == 9) {
            $this->validateCnsStarted7or8or9($fail);
        }


    }

    /**
     * @param $cns
     * @return void
     */
    private function clearCns($cns): void
    {
        $this->cns = preg_replace('/[^0-9]/is', '', $cns);
    }

    /**
     * @return void
     */
    private function setPis(): void
    {
        $this->pis = substr($this->cns, 0, 11);
    }

    /**
     * @param Closure $fail
     * @return void
     */
    private function validateCnsStarted1or2(Closure $fail)
    {
        $sum = (((int)($this->pis . substr(0, 1))) * 15) +
            (((int)($this->pis . substr(1, 2))) * 14) +
            (((int)($this->pis . substr(2, 3))) * 13) +
            (((int)($this->pis . substr(3, 4))) * 12) +
            (((int)($this->pis . substr(4, 5))) * 11) +
            (((int)($this->pis . substr(5, 6))) * 10) +
            (((int)($this->pis . substr(6, 7))) * 9) +
            (((int)($this->pis . substr(7, 8))) * 8) +
            (((int)($this->pis . substr(8, 9))) * 7) +
            (((int)($this->pis . substr(9, 10))) * 6) +
            (((int)($this->pis . substr(10, 11))) * 5);

        $rest = $sum % 11;

        $dv = (11 - $rest);

        if ($dv === 11) {
            $dv = 0;
        }

        if ($dv === 10) {
            $this->verificationDigitEquals10();
        }else{
            $this->result = $this->pis . "000" . $dv;
        }

        if($this->cns != $this->result){
            $fail('The :attribute is incorrect.');
        }
    }


    /**
     * @return void
     */
    private function verificationDigitEquals10(): void
    {
        $sum = (((int)($this->pis . substr(0, 1))) * 15) +
            (((int)($this->pis . substr(1, 2))) * 14) +
            (((int)($this->pis . substr(2, 3))) * 13) +
            (((int)($this->pis . substr(3, 4))) * 12) +
            (((int)($this->pis . substr(4, 5))) * 11) +
            (((int)($this->pis . substr(5, 6))) * 10) +
            (((int)($this->pis . substr(6, 7))) * 9) +
            (((int)($this->pis . substr(7, 8))) * 8) +
            (((int)($this->pis . substr(8, 9))) * 7) +
            (((int)($this->pis . substr(9, 10))) * 6) +
            (((int)($this->pis . substr(10, 11))) * 5) + 2;

        $rest = $sum % 11;

        $dv = (11 - $rest);

        $this->result = $this->pis . "001" . $dv;
    }

    private function validateCnsStarted7or8or9(Closure $fail): void
    {
        $sum = (((int)($this->cns.substr(0,1))) * 15) +
            (((int)($this->cns.substr(1,2))) * 14) +
            (((int)($this->cns.substr(2,3))) * 13) +
            (((int)($this->cns.substr(3,4))) * 12) +
            (((int)($this->cns.substr(4,5))) * 11) +
            (((int)($this->cns.substr(5,6))) * 10) +
            (((int)($this->cns.substr(6,7))) * 9) +
            (((int)($this->cns.substr(7,8))) * 8) +
            (((int)($this->cns.substr(8,9))) * 7) +
            (((int)($this->cns.substr(9,10))) * 6) +
            (((int)($this->cns.substr(10,11))) * 5) +
            (((int)($this->cns.substr(11,12))) * 4) +
            (((int)($this->cns.substr(12,13))) * 3) +
            (((int)($this->cns.substr(13,14))) * 2) +
            (((int)($this->cns.substr(14,15))) * 1);

        $rest = $sum % 11;

        if($rest != 0){
            $fail('The :attribute is incorrect.');
        }
    }

}
