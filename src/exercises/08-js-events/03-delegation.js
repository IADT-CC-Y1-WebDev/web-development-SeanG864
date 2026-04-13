// console.log("hello");

let cardsContainer = document.getElementById("cards");

function handleClicks(event) {
    // console.log(`You clicked on a ${event.currentTarget.tagName} element\n`);
    // console.log(`You clicked on a ${event.target.tagName} element\n`);

    const card = event.target.closest('.card');
    if(!card) {
        return;
    }

    const action = event.target.dataset.action;
    if(action === "select") {
        // console.log("You clicked on a select button");
        toggleCardHighlight(card);
    }
    else if(action === "log") {
        // console.log("You clicked on a log button");
        logCardTitle(card);
    }
}

function toggleCardHighlight(card) {
    card.classList.toggle('selected');
}

function logCardTitle(card) {
    console.log('Card Title:', card.dataset.title);
}

cardsContainer.addEventListener('click', handleClicks);