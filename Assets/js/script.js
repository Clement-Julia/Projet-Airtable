function getApi(data = null, method, url = null){
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


    fetch(URL, header).then((response) => {
        if(response.ok){
            response.json().then((data) => {
                console.log(data);
            });
            console.log(response);
        }else{
            console.log(response);
        }
    }).catch((e) => {
        console.log(e);
    });
}

const upload = async (name, file) => {
    // const file = document.getElementById("validationCustomPhoto").files[0];

    formData = new FormData();
    formData.append("Name", name);
    formData.append("Link", file);
    
    try {
        let response = await fetch('../../Api/apiway.php?table=image', {
            method: 'POST',
            body: formData,
        });
        const result = await response.json();

        return result;
    } catch (error) {
        console.log(error.message);
    }
};