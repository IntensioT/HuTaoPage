function getPrice(){
    let prices = {
        'pepperoni': {
            'small': 2,
            'standart': 5,
            'big': 7
        },
        'margherita': {
            'small': 2,
            'standart': 4,
            'big': 6
        },
        'california': {
            'small': 10,
            'standart': 15,
            'big': 20
        },

        'tomato': 1,
        'cheese': 2,
        'cucumber': 3
    }
    
    let form = document.forms.pizzaOrder;
    let orderPrice = 0;

    orderPrice += prices[form.pizzaType.value][form.pizzaSize.value];
    //console.log(form.addIngridient);
    if(form.cheese.checked){
        orderPrice += prices[form.cheese.value];
    }
    if(form.tomato.checked){
        orderPrice += prices[form.tomato.value];
    }
    if(form.cucumber.checked){
        orderPrice += prices[form.cucumber.value];
    }

    return orderPrice;
}

function onOrderChange(){
    console.log("Here");
    let orderPrice = getPrice();
    let priceTag = document.getElementById("priceTag");
    priceTag.innerHTML = `Цена за заказ: ${orderPrice}$`;
}