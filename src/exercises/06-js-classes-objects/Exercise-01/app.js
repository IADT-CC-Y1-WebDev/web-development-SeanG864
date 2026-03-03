import BankAccount from './classes/BankAccount.js';
import SavingsAccount from './classes/SavingsAccount.js';

// let account1 = new BankAccount(1234567, "Charlie", 300000);

// console.log(account1);

bank = new BankAccount("1111111111", "Alice", 100.00);
savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);

// console.log(bank);
// console.log(savings);

let accounts = [bank, savings]

accounts.forEach((account) => {
    account.toString();
    console.log("----------");
});