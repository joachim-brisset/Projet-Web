(function (){

    function notify() {}

    function updateData(element, id) {
        fetch(`/api/getUser?user_id=${id}`, {credentials:'include'})
            .then( response => response.json())
            .then( data => {
                element.querySelector("input[name=user_username]").value = data['username'];
                element.querySelector("input[name=user_mail]").value = data['mail'];
                element.querySelector("input[name=user_firstname]").value = data['firstname'];
                element.querySelector("input[name=user_lastname]").value = data['lastname'];
                element.querySelector("input[name=user_role_id]").value = data['role_id'];
                element.querySelector("input[name=user_gender]").value = data['gender'];
                element.querySelector("input[name=user_birth_day]").value = data['birth_day'];
                element.querySelector("input[name=user_jobs]").value = data['jobs'];
                element.querySelector("input[name=user_city]").value = data['city'];
                element.querySelector("input[name=user_country]").value = data['country'];
                element.querySelector("input[name=user_cp]").value = data['cp'];
                element.querySelector("input[name=user_street_number]").value = data['street_number'];
                element.querySelector("input[name=user_street]").value = data['street'];
            });
    }

    function handleUpdate(event) {
        event.preventDefault();

        let formData = new FormData(this);
        if(formData.has('delete')) {
            fetch(`/api/deleteUser?user_id=${formData.get("user_id")}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    if(response['success']) window.location.reload(true);
            });

        } else {
            formData.delete("delete");
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);

            fetch(`/api/editUser?${params}`, {credentials: "include"})
                .then(data => data.json())
                .then(response => {
                    updateData(this, formData.get('user_id'));
                })
        }
    }

    const loadUpdateEvent = () => {
        let products = document.querySelectorAll("#all-users-container .ajax-form");
        products.forEach( (item) => item.addEventListener('submit', handleUpdate ));
    }

    function handleAdd(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/addUser?${params}`, {credentials: "include"})
            .then(data => data.json())
            .then(response => {
                if (response['success']) window.location.reload(true);
            });
    }

    const loadAddEvent = () => {
        let product = document.querySelector("#add-user-container .ajax-form");
        product.addEventListener('submit', handleAdd);
    }

    const init = () => {
        loadUpdateEvent();
        loadAddEvent();
    }

    window.addEventListener('load', init);
}) ()