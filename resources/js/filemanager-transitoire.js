

/*DEBUT DU SCRIPT */
/*IMPORTANT NOTICE the images are stored into the directory named private that is 2 levels above the 
web root directory i.e. public for symfony 5.
to access the images in a view we must use the route /private of the PrivateController
*/
/*var rowNumber = 0;
$('#logo').css('height', '80px');
var current_dir = $('#userBaseDir').html();
//privacy is the private folder of the user under the upload directory
var priv = current_dir.split('/');
var privacy = priv[priv.length - 1];
if (privacy != "admin") {
    privacy = "admin/" + privacy;
}

console.clear();
console.log("privacy is " + privacy);
var webRelativeUploadDirectory = "/../../private";
console.log('web rel route is ' + webRelativeUploadDirectory);

var ar = current_dir.split('/');
var username = ar[ar.length - 1];

console.log("username is " + username);
var xsrf = $("#xsrf").html();
var accepted_types = ['jpeg'];
const MAX_FILE_SIZE = 800000;
var cpt = 0;
var selection;
var isDownKey = [];
var selectedRows = [];
var lastSelectedRow = undefined;*/
$(document).ready(function () {
    var current_dir = $('#userBaseDir').html();
    console.log("in list function");

    rowNumber = 0;
    $('.delete_selection').addClass('fmg_hide');
  
    var url='filemanager';
    console.log("url is " + url);
    console.log("in list function current_dir is " + current_dir);
    jQuery.ajax({
        dataType: 'json',
        type: 'POST',
        url:"http://localhost:8000/filemanager/manage",
        data: { to_do: 'list', dir: current_dir },
     
        success: function (data) {

            $('#fmg_listing').empty();
            if (data.success) {
                console.log('list dir success ' + new Date().getTime());
                console.log("the dir is " + data.dir);
                $.each(data.results, function (index, file) {
                    $('#fmg_listing').append(filemanager.fileRow(file, index));
                    rowNumber = rowNumber + 1;
                    $('#rowNumber').html(rowNumber);
                });
            }
            filemanager.updateBreadCrumb(current_dir.replace($("#userBaseDir").html(), ''));
        },
      error: function (request, status, errorThrown) {
            alert('error from list function: ' + errorThrown + '!!S');
        },
        complete: function (request, status) {
            //alert(status);
            $('#fmg_upload_progress').fadeOut(10);
            //console.log('current_dir is : ' + current_dir);
            $("#fmg_preview").hide();
        }
         /* */
    });
});