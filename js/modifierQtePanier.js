(function (){

    function succeed() {
        let amount = document.querySelector("#CartAmount")
        fetch(`/api/getCartAmount`, {credentials:"include"})
            .then(data => data.json())
            .then(response => {
                if(response['success']) amount.innerHTML = response['value'];
            })
    }

    function handleSubmit(event) {
        event.preventDefault();

        let formdata = new FormData(this);
        let params = Array.from(formdata, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);

        fetch(`/api/changeProductQuantity?${params}`, {credentials:"include"})
            .then(data => data.json())
            .then(response => {
               if (response['success']) succeed(); else window.location.reload(true);
            });


    }

    function init() {
        let products = document.querySelectorAll(".productForm");
        products.forEach( product => product.addEventListener("submit", handleSubmit))
    }

    window.addEventListener('load', init);
})()