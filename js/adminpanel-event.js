(function (){

    function notify() {}

    function updateData(element, id) {
        fetch(`/api/getEvent?event_id=${id}`)
            .then( response => response.json())
            .then( data => {
                element.querySelector("input[name=event_name]").value = data['name'];
                element.querySelector("input[name=event_desc]").value = data['description'];
                element.querySelector("input[name=event_place]").value = data['place'];
                element.querySelector("input[name=event_start]").value = data['start_at'];
                element.querySelector("input[name=event_end]").value = data['end_at'];
                element.querySelector("input[name=event_price]").value = data['price'];
                element.querySelector("input[name=event_place_number]").value = data['place_number'];
            });
    }

    function handleUpdate(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/editEvent?${params}`).then(data => data.json()).then(response => {
            notify(response['success'] ? "Successfully update data" : "Unsuccessfully update data", 2);
            updateData(this, formData.get('event_id'));
        });

    }

    function loadUpdateEvent() {
        let ajax = document.querySelectorAll("#all-event-container .ajax-form");
        ajax.forEach((item) => item.addEventListener('submit', handleUpdate )) /*You can't rebind arrow function*/
    }

    function handleAdd(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/addEvent?${params}`).then(data => data.json()).then(response => {
            if (response['success']) window.location.reload(true);
        })
    }

    function loadAddEvent() {
        let item = document.querySelector("#add-event-container .ajax-form");
        item.addEventListener('submit', handleAdd);
    };

    function init() {
        loadUpdateEvent();
        loadAddEvent();
    }

    window.addEventListener('load', init);
}) ()