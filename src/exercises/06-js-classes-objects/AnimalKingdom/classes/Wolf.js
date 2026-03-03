import Canine from "./Canine.js";

class Wolf extends Canine {

    constructor(_name, _age) {
        super(_name, _age);
    }

    makeNoise() {
        console.log("awooooooo");
    }

}

export default Wolf;