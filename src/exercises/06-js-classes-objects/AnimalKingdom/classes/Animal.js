class Animal {
    constructor(_name, _age) {
        this.name = _name;
        this.age = _age;
    }

    sleep() {
        console.log("zzzzzzzzz");
    }

    makeNoise() {
        console.log("Noises...");
    }

    roam() {
        console.log("Roaming")
    }
}

export default Animal;