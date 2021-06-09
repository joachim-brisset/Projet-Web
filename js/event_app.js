(function () {

    function updateData2() {
        let seat = document.querySelector("#free-seats");
        if(freeSeat = Number.parseInt(seat.innerHTML)) seat.innerHTML = (freeSeat + 1).toString();
    }
    function updateData1() {
        let seat = document.querySelector("#free-seats");
        if(freeSeat = Number.parseInt(seat.innerHTML)) seat.innerHTML = (freeSeat - 1).toString();
    }

    function handleUnregistration(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) =>`${key}=${value}`).reduce( (x,y) => x + "&" + y);

        this.querySelector("input[type=submit]").value = "fetching";
        fetch(`/api/unregisterEvent?${params}`).then(data => data.json()).then(response => {
            if (response['success']) {
                this.addEventListener('submit', handleRegistration, {once: true});
                this.querySelector("input[type=submit]").value = "s'inscrire";
                updateData2();
            } else {
                this.addEventListener('submit', handleUnregistration, {once: true});
                this.querySelector("input[type=submit]").value = "Fail unregistration";
                setTimeout(() => this.querySelector("input[type=submit]").value = "Se desinscrire", 1000);

                if(response['cause'] == "not auth") {
                    window.location.replace("/sign-in");
                }
            }
        });
    }


    function handleRegistration(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let params = Array.from(formData, ([key, value]) =>`${key}=${value}`).reduce( (x,y) => x + "&" + y);

        this.querySelector("input[type=submit]").value = "fetching";
        fetch(`/api/registerEvent?${params}`).then(data => data.json()).then(response => {
            if (response['success']) {
                this.addEventListener('submit', handleUnregistration, {once: true});
                this.querySelector("input[type=submit]").value = "Se desinscrire";
                updateData1();
            } else {
                this.addEventListener('submit', handleRegistration, {once: true});
                this.querySelector("input[type=submit]").value = "Fail registration";


                if(response['cause'] == "not auth") {
                    window.location.replace("/sign-in");
                } else if(response['cause'] == "Full") {
                    setTimeout(() => this.querySelector("input[type=submit]").value = "Full", 1000);
                } else {
                    setTimeout(() => this.querySelector("input[type=submit]").value = "S'inscrire", 1000);
                }
            }
        });
    }

    const loadRegistrationEvent = () => {
        let registerForms = document.querySelectorAll(".ajax-form.register");
        registerForms.forEach( item => item.addEventListener('submit', handleRegistration, {once: true}));

        let unregisterForms = document.querySelectorAll(".ajax-form.unregister");
        unregisterForms.forEach( item => item.addEventListener('submit', handleUnregistration, {once: true}));
    }

    const init = () => {
        loadRegistrationEvent();
    }

    window.addEventListener('load', init);
}) ()