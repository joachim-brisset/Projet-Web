(function(){

        
    function succed(){
        
    }

    function handleSubmit(event){
        event.preventDefault();
        let formdata = new FormData(this);
        let params = Array.from(formdata, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);
        fetch(`/api/addProductToCart?${params}`, {credentials:"include"}).then(data=>data.json()).then(response=>{
            if(response["success"]){
                succed();
            }
        })
    }

    function init(){
        let el = document.querySelector("#productForm");
        el.addEventListener("submit", handleSubmit);
    }
    window.addEventListener("load", init);
})()