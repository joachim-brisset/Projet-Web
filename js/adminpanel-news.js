(function (){

    function notify() {}

    function updateData(element, id) {
        fetch(`/api/getNews?news_id=${id}`, {credentials:'include'})
            .then( response => response.json())
            .then( data => {
                element.querySelector("input[name=news_title]").value = data['title'];
                element.querySelector("input[name=news_picture_url]").value = data['picture_url'];
                element.querySelector("input[name=news_corps]").value = data['corps'];
                element.querySelector("input[name=news_created_at]").value = data['created_at'];
            });
    }

    function handleUpdate(event) {
        event.preventDefault();

        let formData = new FormData(this);
        if(formData.has('delete')) {
            fetch(`/api/deleteNews?news_id=${formData.get("news_id")}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    if(response['success']) window.location.reload(true);
            });

        } else {
            formData.delete("delete");
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);

            fetch(`/api/editNews?${params}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    updateData(this, formData.get('news_id'));
                })
        }
    }

    const loadUpdateEvent = () => {
        let products = document.querySelectorAll("#all-news-container .ajax-form");
        products.forEach( (item) => item.addEventListener('submit', handleUpdate ));
    }

    function handleAdd(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/addNews?${params}`, {credentials: "include"})
            .then(data => data.json())
            .then(response => {
                if (response['success']) window.location.reload(true);
            });
    }

    const loadAddEvent = () => {
        let product = document.querySelector("#add-news-container .ajax-form");
        product.addEventListener('submit', handleAdd);
    }

    const init = () => {
        loadUpdateEvent();
        loadAddEvent();
    }

    window.addEventListener('load', init);
}) ()