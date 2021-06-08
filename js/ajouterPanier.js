(function(){
    function init(){
        console.log("test");
        let el = document.querySelector("#productForm");
        console.log(el);
        el.addEventListener("submit", (event)=>{
            event.preventDefault();
            console.log("test");
            let formdata = new FormData(this);
            let params = Array.from(formdata, ([key, value]) => `${key}=${value}`).reduce((x, y) => x + "&" + y);
            fetch(`/api/addProductToCart?${params}`, {credentials:"include"}).then(data=>data.json()).then(response=>{
                if(response["success"]){
                    succed();
                }
            })
        })
    }
    window.addEventListener("load", init);
    
    function succed(){
        
    }
})()