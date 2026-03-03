import BankAccount from "./BankAccount";

class SavingsAccount extends BankAccount {

    constructor(_num, _name, _bal, _rate) {
        super(_num, _name, _bal);
        this.interestRate = _rate;
    }

    // Override __toString() to include interest rate
    toString() {
        rate = this.interestRate * 100;
        // return "Savings Account: {$this->number}, Name: {$this->name}, " .
        //        "Balance: €{$this->balance}, Interest: {$rate}%";
               console.log(`Savings Account:${_num}`);
               console.log(`Name:${_name}`);
               console.log(`Balance:${_bal}`);
               console.log(`Interest:${this.interestRate}`);
    }
}

export default SavingsAccount;