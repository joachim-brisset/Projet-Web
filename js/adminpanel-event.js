(function (){

    function notify() {}

    function updateData(element, id) {
        fetch(`/api/getEvent?event_id=${id}`, {credentials:'include'})
            .then( response => response.json())
            .then( data => {
                element.querySelector("input[name=event_name]").value = data['name'];
                element.querySelector("input[name=event_desc]").value = data['description'];
                element.querySelector("input[name=event_place]").value = data['place'];
                element.querySelector("input[name=event_start]").value = data['start_at'];
                element.querySelector("input[name=event_end]").value = data['end_at'];
                element.querySelector("input[name=event_price]").value = data['price'];
                element.querySelector("input[name=event_place_number]").value = data['place_number'];
                element.querySelector("input[name=event_cost]").value = data['event_cost'];
            });
    }

    function handleUpdate(event) {
        event.preventDefault();

        let formData = new FormData(this);
        if (formData.has("delete")) {
            fetch(`/api/deleteEvent?event_id=${formData.get("event_id")}`, {credentials: "include"}).then(data => data.json()).then(response => {
                if(response['success']) window.location.reload(true);
            });

        } else {
            formData.delete("delete");
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);
            fetch(`/api/editEvent?${params}`, {credentials:'include'}).then(data => data.json()).then(response => {
                notify(response['success'] ? "Successfully update data" : "Unsuccessfully update data", 2);
                updateData(this, formData.get('event_id'));
            });
        }

    }

    function loadUpdateEvent() {
        let ajax = document.querySelectorAll("#all-event-container .ajax-form.event-info");
        ajax.forEach((item) => item.addEventListener('submit', handleUpdate )) /*You can't rebind arrow function*/
    }

    function handleAdd(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

        fetch(`/api/addEvent?${params}`, {credentials:'include'}).then(data => data.json()).then(response => {
            if (response['success']) window.location.reload(true);
        })
    }

    function loadAddEvent() {
        let item = document.querySelector("#add-event-container .ajax-form.event-info");
        item.addEventListener('submit', handleAdd);
    };

    const loadExpandEvent = () => {
        let events = document.querySelectorAll("#all-event-container .event");
        events.forEach( eventDiv => {
            function handleExpand(event) {
                eventDiv.classList.toggle("expanded")
            }
            eventDiv.querySelector(".expand-button").addEventListener('click', handleExpand );
        });
    }

    const loadRemoveUserEvent = () => {
        function handleRemoveUser(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);
            console.log(params)

            fetch(`/api/unregisterEvent?${params}`, {credentials:'include'}).then(data => data.json()).then(response => {
                if (response['success']) {
                    window.location.reload(true);
                }
            })
        }

        let userInfoForms = document.querySelectorAll("#all-event-container .ajax-form.user-info");
        userInfoForms.forEach( form => form.addEventListener('submit', handleRemoveUser))
    }

    function init() {
        loadUpdateEvent();
        loadAddEvent();
        loadExpandEvent();
        loadRemoveUserEvent();
    }

    window.addEventListener('load', init);
}) ()