async function getApi(data = null, method, url = null){
    const API_KEY = "keyCJAnKSTSgRGION";
    
    let URL = `https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?api_key=${API_KEY}`;
    if(url != null){
        URL = url+`?api_key=${API_KEY}`;
    }

    if(data != null){
        var data = {
            'records': [
                data
            ]
        };
    }

    var header = {
        method: method,
        headers: {
            'Content-Type':'application/json'
        }
    }
    if(method != "DELETE"){
        header.body = JSON.stringify(data)
    }
    
    let result = await fetch(URL, header).then((response) => {
        console.log(response)
        if(response.ok){
            response.json().then((data) => {
                return "ok";
            });
            return "ok";
        }else{
            return "error";
        }
    }).catch((e) => {
        return "error";
    });
    return result;

}

const upload = async (name, file) => {
    formData = new FormData();
    formData.append("Name", name);
    formData.append("Link", file);
    var result = [];
    
    try {
        let response = await fetch('../../Api/apiway.php?table=image', {
            method: 'POST',
            body: formData,
        });
        result["success"] = true;
        result["data"] = await response.json();

        return result;
    } catch (error) {
        result["success"] = false;
        result["message"] = error.message;
    }
    return result;
};

$('.selectpicker').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
    if (e.target.options[clickedIndex].selected) {
        // console.log(e.target.options[clickedIndex].value);
    }
});