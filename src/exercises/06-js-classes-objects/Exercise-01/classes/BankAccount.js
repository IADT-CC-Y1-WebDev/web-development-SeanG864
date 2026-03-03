class BankAccount {

    constructor(_num, _name, _bal) {
        this.number = _num;
        this.name = _name;
        this.balance = _bal;
    }

    public function __toString() {
        return "Account: {$this->number}, Name: {$this->name}, Balance: €{$this->balance}";
    }
}