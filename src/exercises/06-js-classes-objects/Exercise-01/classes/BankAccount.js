class BankAccount {

    constructor(_num, _name, _bal) {
        this.number = _num;
        this.name = _name;
        this.balance = _bal;
    }

    toString() {
        console.log(`Account:${this.number}`);
        console.log(`Name:${this.name}`);
        console.log(`Balance:${this.balance}`);
    }
}

export default BankAccount;