ajax = {}

request = (options)=>{

    httpObject = new XMLHttpRequest()

    httpObject.onreadystatechange = ()=>{

        if(httpObject.readyState === XMLHttpRequest.DONE)

            if(httpObject.status >= 200 && httpObject.status < 400) 

                options.sucess(JSON.parse(httpObject.responseText))

             else 
                options.error();            
    }

    return httpObject;
}

ajax.get= (url,sucess,beforeSend)=>{

    sucess = (typeof sucess === 'undefined')? function(){} : sucess
    beforeSend = (typeof beforeSend === 'undefined')? function(){} : beforeSend

    ajax.request({
        type : 'GET',
        url : url,
        sucess: sucess,
        beforeSend: beforeSend

    })

}

ajax.post = (url,data,sucess,beforeSend)=>{

    sucess = (typeof sucess === 'undefined')? function(){} : sucess
    beforeSend = (typeof beforeSend === 'undefined')? function(){} : beforeSend

    ajax.request({
        type : 'POST',
        url : url,
        data: data,
        sucess: sucess,
        beforeSend : beforeSend
    })

}

ajax.request = (options)=>{

    options.type = options.type ||  'GET' 
    options.url = options.url || ''
    options.data = options.data || ''
    
    options.url = options.url 

    httpObject = request(options)

    httpObject.open(options.type, options.url);
    options.beforeSend()
    httpObject.setRequestHeader('Content-Type', 'application/json');
    httpObject.setRequestHeader('Access-Control-Allow-Origin', 'localhost');
    httpObject.send((typeof options.data == "object") ? JSON.stringify(options.data)  : options.data)

}





