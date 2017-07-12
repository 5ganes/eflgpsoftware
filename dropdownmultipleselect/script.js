var count = 0;
function showSelect(){
    var box = document.getElementById('box');
    if(count % 2 == 0) status = 'block'; else status = 'none';
    box.style.display = status;
    count++;
}
function myFunction(){
    var el = document.getElementById('fiscalYear');
    var box = document.getElementById('box');
    box.style.display = 'none';
    el.addEventListener('click', showSelect);
    var box = document.getElementById('box');
    var boxli = box.getElementsByTagName('li');
    for(var i = 1; i < boxli.length; i++){
        boxli[i].addEventListener('click', function(){
            var boxlicheckbox = this.getElementsByTagName('input')[0];
            if(boxlicheckbox.checked == false){
                boxlicheckbox.checked = true;
                this.style = 'background:#e3cfcf;';
            }
            else{ 
                boxlicheckbox.checked = false;
                this.style = 'background:#a2cce2;';
            }
        });
    }

    var checkall = document.getElementById('checkall'); var chechallstatus = false;
    checkall.addEventListener('click', function(){
        // alert('sdf');
        allcheckboxes = document.getElementsByName('fiscalYear[]');
        if(chechallstatus == false){
            for(var i=0;i<allcheckboxes.length;i++){  
                allcheckboxes[i].checked = true; allcheckboxes[i].parentNode.style = 'background:#e3cfcf;';
            }
            checkall.innerHTML = 'Uncheck All';
            chechallstatus = true;
        }
        else{
           for(var i=0;i<allcheckboxes.length;i++){  
                allcheckboxes[i].checked = false; allcheckboxes[i].parentNode.style = 'background:#a2cce2;';
            }
            checkall.innerHTML = 'Check All';
            chechallstatus = false;
        }
    });
}
document.addEventListener('DOMContentLoaded', myFunction);