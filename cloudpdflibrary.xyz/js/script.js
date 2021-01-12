var srcPDF = "https://drive.google.com/file/d/1T6OVsKgd0Zq0dp-ayo8V_xcXHWuchJbq/preview?usp=sharing";
var iFrame = document.getElementById("iFrame");
var input = document.getElementById("prompt");
var console = document.getElementById("console");
var m_isVisible = true;
var m_button = document.getElementById("m_button");



//called by button prompt
function update_f(){
    editUrl();
    srcPDF = input.value;
    if(srcPDF.slice(0, 31)=="https://drive.google.com/file/d"){
        //iFrame.style.display = "";
        iFrame.style.visibility = "visible";
        iFrame.setAttribute("src", srcPDF);
        editUrl();
        iFrame.setAttribute("src", srcPDF);
        console.innerHTML = "OK";
    }
    else{
        //iFrame.style.display = "none";
        iFrame.style.visibility = "hidden";
        iFrame.setAttribute("src", srcPDF);
        console.innerHTML = "Oh no!, URL provided is not valid D:";
    }
}
//called onload body
function onLoad(){
    editUrl();
    update_f();
    console.innerHTML = "Page is loaded!";
}

function hideun_m(){
    if (m_isVisible==true){
        m_isVisible = false;
        m_button.setAttribute("src", "images/eye_closed.png");
        document.getElementById("pdf").style.display = "none";
    }
    else{
        m_isVisible = true;
        m_button.setAttribute("src", "images/eye_open.png");
        document.getElementById("pdf").style.display = "block";
    }
}

