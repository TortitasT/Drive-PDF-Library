var position;
var prompt = document.getElementById("prompt");

function editUrl(){
    var srcPDF = input.value;
    position = srcPDF.lastIndexOf("view");

    if (position==-1){
        document.getElementById("console").innerHTML = "Oh no!, URL provided is not valid D:";
    }
    else {
        document.getElementById("console").innerHTML = "OK";
    }

    if (srcPDF.lastIndexOf("preview") != -1){
    prompt.value = srcPDF.slice(0, position)+"view?usp=sharing";
    }
    else {
    if(prompt.value != ""){
    prompt.value = srcPDF.slice(0, position)+"preview?usp=sharing";
    }
    }

}