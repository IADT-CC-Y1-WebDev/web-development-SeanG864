import Cat from './classes/Cat.js';
import Dog from './classes/Dog.js';
import Wolf from './classes/Wolf.js';
import Lion from './classes/Lion.js';

let cat = new Cat ("Tom", 2);
let dog = new Dog ("Buddy", 3);
let wolf = new Wolf ("Fang", 4);
let lion = new Lion ("Lloyd", 4);

let animals = [cat, dog, wolf, lion]

animals.forEach((animal) => {
    animal.makeNoise();
    animal.roam();
    animal.sleep();
    console.log("----------");
});