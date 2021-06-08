(function (){

    const updateData = (element, id) => {
        fetch(`/api/getProduct?product_id=${id}`, {credentials:'include'})
            .then(data => data.json())
            .then(response => {
                element.querySelector("input[name=product_name]").value = response['name'];
                element.querySelector("input[name=product_price]").value = response['price'];
                element.querySelector("input[name=product_stocks]").value = response['stocks'];
                element.querySelector("input[name=product_initial_stock]").value = response['initial_stock'];
                element.querySelector("input.sold").value = response['initial_stock'] - response['stocks'];
            })
    }

    function handleUpdate(event) {
        event.preventDefault();

        let formData = new FormData(this);
        if(formData.has('delete')) {
            fetch(`/api/deleteProduct?product_id=${formData.get("product_id")}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    if(response['success']) window.location.reload(true);
            });

        } else {
            formData.delete("delete");
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);

            fetch(`/api/editProduct?${params}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    updateData(this, formData.get('product_id'));
                })
        }
    }

    const loadUpdateEvent = () => {
        let products = document.querySelectorAll("#all-products-container .ajax-form");
        products.forEach( (item) => item.addEventListener('submit', handleUpdate ));
    }

    function handleAdd(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/addProduct?${params}`, {credentials: "include"})
            .then(data => data.json())
            .then(response => {
                if (response['success']) window.location.reload(true);
            });
    }

    const loadAddEvent = () => {
        let product = document.querySelector("#add-product-container .ajax-form");
        product.addEventListener('submit', handleAdd);
    }

    const init = () => {
        loadUpdateEvent();
        loadAddEvent();
    }

    window.addEventListener('load', init);
}) ()