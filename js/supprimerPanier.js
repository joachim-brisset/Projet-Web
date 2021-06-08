(function(){

        
    function succed(){
        let el = document.querySelector(".panier");
        while (el.firstChild) el.removeChild(el.firstChild);
    }

    function handleSubmit(event){
        event.preventDefault();
        
        fetch(`/api/clearCart`, {credentials:"include"}).then(data=>data.json()).then(response=>{
            if(response["success"]){
                succed();
            }
        })
    }

    function init(){
        let el = document.querySelector("#clearCart-but");
        el.addEventListener("click", handleSubmit);
    }
    window.addEventListener("load", init);
})()