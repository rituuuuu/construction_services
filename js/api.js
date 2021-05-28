
$( "#update_construction" ).submit(function( event ) {
    event.preventDefault(); 
    company_name = ("#owner_name").value;
    company=('#company').value;
    state=$('#state').find(":selected").text();
    city=$('#city').find(":selected").text()
    profession=$('#profession').find(":selected").text()

});

var cityjson=null;
var profession=['all','Plumber',"Carpentor","Electrician","Workers","Designer","Architect"];
var materials=['all','Bricks','Paints','Plumbing materials','Hardwares',"Furnitures",'Tiles'];
var empty_result="<h4>No result found</h4>"
$.getJSON( "admin/assets/json/cities.json", function( data ) {
     cityjson=data
     append_select(Object.keys(cityjson),"state");
});

append_select(profession,"profession");
append_select(materials,"material");

if($('#state').find(":selected").text().length)
{
    append_select(cityjson[$('#state').find(":selected").text()],'city');
}

function append_select(array,id)
{
    $(array).each(function( key, value ) {
        $('#'+id).append(new Option(value, value));
      });
}


$("#state").change(function()
{
    var type=$("#service-type").attr('name');
    var service=$("select[name=service_dropdown]").find(":selected").text()
    $('#city').children().remove();
    $('#city').append(new Option('all', 'all'));
    append_select(cityjson[this.value],'city');
    $(".list-container").empty();
    var formData = new FormData();
    formData.append('state', this.value);
    formData.append('type', type);
    formData.append('service',service)
    var data=apicall('api_call.php','POST',formData,changelist);
});


$("#city").change(function()
{
    var type=$("#service-type").attr('name');
    var service=$("select[name=service_dropdown]").find(":selected").text()
    $(".list-container").empty();
    var formData = new FormData();
    formData.append('city', this.value);
    formData.append('state', $('#state').find(":selected").text());
    formData.append('type', type);
    formData.append('service',service);
    var data=apicall('api_call.php','POST',formData,changelist);
});

$("select[name=service_dropdown]").change(function()
{
    var type=$("#service-type").attr('name');
    $(".list-container").empty();
    var formData = new FormData();
    formData.append('city', $('#city').find(":selected").text());
    formData.append('state', $('#state').find(":selected").text());
    formData.append('type', type);
    formData.append('service',$("select[name=service_dropdown]").find(":selected").text());
    var data=apicall('api_call.php','POST',formData,changelist);
});

function apicall(url_link,method,formdata,changelist)
{
    $.ajax({
        url: url_link,
        type: method,
        processData: false,
        contentType: false,
        data:formdata,
        enctype: 'multipart/form-data',
        success: function(data){
            changelist(JSON.parse(data));
        },
        error:function(data){
        }
    });
}

var materials_icon={'Bricks':'images/materials/brickwall.svg','Paints':'images/materials/paint-bucket.svg'
,'Plumbing materials':'images/materials/water-pipe.svg',
'Hardwares':'images/materials/screwdriver.svg',"Furnitures":'images/materials/furnitures.svg',
'Tiles':'images/materials/tile.svg'
};

var worker_icon={'Plumber':'images/workers/plumber.svg','Carpentor':'images/workers/carpenter.svg'
,'Electrician':'images/workers/electrician.svg',
'Workers':'images/workers/workers.svg',"Designer":'images/workers/architect.svg',
'Architect':'images/workers/architect.svg'
};

function changelist(resp)
{
    var list_html='<div class="row tile">'+
    '<div class="col-sm-2">'+
    '<div class="tile-icon">'+
    '<img class="tile-icon-image" src="[icon_svg]" alt="">'+
    '</div>'+
    '</div>'+
    '<div class="col-sm-10">'+
    '<div class="card">'+
    '<div class="card-body">'+
    '<h5 class="card-title">[name]</h5>'+
    '<p class="card-text">[company]</p>'+
    '<p class="card-text">[service]</p>'+
    '<button type="button" onClick="details_buttonClick([id])" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Get Details</button>'+
    '</div>'+
    '</div>'+
    '</div>'+'</div>';
    var type=$("#service-type").attr('name');
    if(type=='material')
    {
        for(var k in resp.data) {
            var tag_string= list_html.replace('[name]', resp.data[k].name)
            tag_string= tag_string.replace('[company]', resp.data[k].company_name)
            tag_string= tag_string.replace('[service]', resp.data[k].material)
            tag_string= tag_string.replace('[id]', resp.data[k].id)
            var svg='images/materials/screwdriver.svg';
            if(resp.data[k].material in materials_icon)
            {
                svg=materials_icon[resp.data[k].material];
            }
            tag_string= tag_string.replace('[icon_svg]', svg)
            
            $(".list-container").append(tag_string);
        }
    }
    else if(type='worker')
    {
        console.log(resp.data);
        for(var k in resp.data) {
            var tag_string= list_html.replace('[name]', resp.data[k].owner_name)
            tag_string= tag_string.replace('[company]', resp.data[k].company_name)
            tag_string= tag_string.replace('[service]', resp.data[k].service_type)
            tag_string= tag_string.replace('[id]', resp.data[k].owner_id)
            var svg='images/workers/workers.svg';
            if(resp.data[k].service_type in worker_icon)
            {
                svg=worker_icon[resp.data[k].service_type];
            }
            tag_string= tag_string.replace('[icon_svg]', svg)
            
            $(".list-container").append(tag_string);
        }
    }
    
    if($('.list-container').is(':empty'))
    {
        $(".list-container").append(empty_result)
    }
}

function details_buttonClick(id)
{
    var type=$("#service-type").attr('name');
    var formData = new FormData();
    formData.append('id', id);
    formData.append('type', type);
    var data=apicall('get_service_data.php','POST',formData,changemodel);
}

function changemodel(response)
{
    var type=$("#service-type").attr('name');
    if(type=='material')
    {
        var model_body='<u1 class="service-details">'+
        '<li>Name: '+response.data[0].name+'</li>'+
        '<li>Service Type: '+response.data[0].material+'</li>'+
        '<li>Company Name: '+response.data[0].company_name+'</li>'+
        '<li>Contact Number: '+response.data[0].contact_number+'</li>'+
        '<li>Email ID: '+response.data[0].email+'</li>'+
        '<li>City: '+response.data[0].city+'</li>'+
        '</u1>'
    }
    else
    {
        var model_body='<u1 class="service-details">'+
        '<li>Owner Name: '+response.data[0].owner_name+'</li>'+
        '<li>Profession: '+response.data[0].service_type+'</li>'+
        '<li>Company Name: '+response.data[0].company_name+'</li>'+
        '<li>Contact Number: '+response.data[0].contact_number+'</li>'+
        '<li>Email ID: '+response.data[0].email+'</li>'+
        '<li>City: '+response.data[0].city+'</li>'+
        '</u1>'
    }
    
    $(".modal-body").empty();
    $(".modal-body").append(model_body);
}

  
