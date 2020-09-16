/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/filemanager.js":
/*!*************************************!*\
  !*** ./resources/js/filemanager.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var filemanager = {
  updateBreadCrumb: function updateBreadCrumb(path) {
    $('#fmg_breadcrumb').empty();
    var domain = '⌂';
    $('#fmg_breadcrumb').append($('<a href=""><span class="fmg_bc_base">' + domain + '</span></a>')); //Warning: these are not links. It is javacript the manage the click on class bc_element

    $.each(path.split('/'), function (key, text) {
      if (text) {
        $("#fmg_breadcrumb").append($('<span class="fmg_bc_separator"> ▸ </span> '));
        $("#fmg_breadcrumb").append($('<span id="' + key + '" class="bc_element fmg_bc_element">' + text + '</span>'));
      }
    });
  },
  //manage row selection for deletion
  manageSelection: function manageSelection(row) {
    if (row.hasClass('row_selected')) {
      filemanager.toggleRow(row); //le div d'id fmg_preview est celui dans lequel l'image de la ligne selectionnée
      //est placé. La taille et la position sont définies dans le CSS

      $("#fmg_preview").empty().hide();
    } else {
      //17 ctrl
      if (isDownKey[17]) {
        //the ctrl key is down to allow multiple selection
        filemanager.toggleRow(row); //allow the delete_selection button to show up

        $('.delete_selection').removeClass('fmg_hide');
      } else {
        //16 shift
        if (isDownKey[16]) {
          if (lastSelectedRow) {
            var j = row.attr('id');
            var minRowNum = Math.min(lastSelectedRow, j);
            var maxRowNum = Math.max(lastSelectedRow, j);

            for (i = minRowNum; i <= maxRowNum; i++) {
              $('tr[id="' + i + '" ]').addClass('row_selected');

              if (i === maxRowNum) {
                //allow the delete_selection button to show up
                $('.delete_selection').removeClass('fmg_hide');
              }
            }
          }
        } else {
          filemanager.clearSelection(); //passe de sélectionné à non sélectionné et vice versa

          filemanager.toggleRow(row);
        }
      } //here coordinate of the pictures are elaborated for display in the preview popup


      if ($(".row_selected")) {
        var link = $(".row_selected").find("td.first").find("span").find("a");
        var relative_dir = current_dir.replace($('#userBaseDir').html(), '');
        console.log('relative dir is ' + relative_dir);
        var image_route = 'storage/photos/' + privacy + relative_dir + '/' + link.html();
        console.log('image_route is ' + image_route);
        $("#fmg_preview").empty().append('<img src="' + image_route + '" />');
        $("#fmg_preview").show();
      }
    }
  },
  //toggle row selection 
  toggleRow: function toggleRow(row) {
    if (row.hasClass('row_selected')) {
      row.removeClass('row_selected');
    } else {
      row.addClass('row_selected');
      lastSelectedRow = row.attr('id');
    }
  },
  clearSelection: function clearSelection() {
    $('.row_selected').each(function (index) {
      filemanager.toggleRow($(this));
      lastSelectedRow = undefined;
    });
    $("#fmg_preview").hide();
    $('.delete_selection').addClass('fmg_hide');
  },
  rowFileName: function rowFileName(row) {
    var r = row.find($('a')).first().html();
    return r;
  },
  //delete the selected files
  deleteSelection: function deleteSelection() {
    var toBeDeleted = []; //we must memorize the filenames as the first deletion
    //will erase the row_selected classes

    $('#fmg_table tr').each(function () {
      if ($(this).hasClass('row_selected')) {
        toBeDeleted.push(filemanager.rowFileName($(this)));
      }
    });
    console.log(toBeDeleted);
    $.each(toBeDeleted, function (index, value) {
      filemanager.deleteFile(current_dir + '/' + value);
    });
    $("#fmg_preview").empty().hide();
  },
  //create a file row in the main windows
  fileRow: function fileRow(file_info, index) {
    var link = $('<span />').attr({}).html(file_info.is_dir ? file_info.name : '<a href="file://' + current_dir + '/' + file_info.name + '">' + file_info.name + '</a>') // '<a >' + file_info.name + '</a>')
    .addClass(file_info.is_dir ? 'name' : 'filename');
    var download_link = $('<a/>').attr({
      text: 'Télécharger',
      href: ''
    });
    var delete_link = $('<span/>').attr({
      "class": 'delete',
      data_file: current_dir + '/' + file_info.name
    }).html('Supprimer');
    var perms = [];
    if (file_info.is_readable) perms.push('lecture');
    if (file_info.is_writable) perms.push('écriture');
    if (file_info.is_executable) perms.push('exécution');
    var html = $('<tr>').addClass(file_info.is_dir ? 'directory' : '').attr('id', index).append($('<td class="first" />').append(file_info.is_dir ? "<span class = 'my-icons-aqua fas fa-folder-open fa-xs' > </span> " : "").append(link)).append($('<td/>').attr('data-sort', file_info.is_dir ? -1 : file_info.size).html($('<span class="size" />').text(file_info.size))).append($('<td/>').attr('data-sort', file_info.mtime).text(file_info.mtime)).append($('<td/>').text(perms.join('+'))).append($('<td/>').append(download_link).append(file_info.is_deleteable ? delete_link : ''));
    return html;
  },
  //create a thumbnail for the progress line
  createThumbnail: function createThumbnail(file, row) {
    var image = $('img', row);
    var reader = new FileReader(); //image.width = 100;
    // image.height = 100;

    reader.onload = function (e) {
      // e.target.result holds the DataURL which
      // can be used as a source of the image:
      image.attr('src', e.target.result);
    }; // Reading the file as a DataURL. When finished,
    // this will trigger the onload function above:


    reader.readAsDataURL(file);
  },
  //add a line to display progress and thumbnail
  renderFileUploadRow: function renderFileUploadRow(file, folder) {
    var $row = $('<div/>').append($('<span class="imageholder" ><img style="width: 120px; height:90px;" class="fmg_thumbnail" /></span>')).append($('<span class="fileuploadname" />').text((folder ? folder + '/' : '') + file.name)).append($('<div class="progress_track"><div class="progress"></div></div>')).append($('<span class="size" />').text(file.size));
    return $row;
  },
  // resize image before upload
  // if resize is not required
  // please use upload(file) instead
  // resize image before upload
  // if resize is not required
  // please use upload(file) instead
  resizeAndUploadOld: function resizeAndUploadOld(file) {
    var $row = filemanager.renderFileUploadRow(file, current_dir);
    var action_url = $('#actionUrl').html(); //the thumbnail in the upload line

    var thumb = $('img', $row);
    $('#fmg_upload_progress').append($row);
    $row.find('.progress').css('width', 0 + '%');
    var form = $("#fmg_file_form");
    var form_data = new FormData();
    form_data.append('to_do', 'upload_resize'); //form_data.append('file_data', file);//file is not required with resize

    form_data.append('folder', current_dir);
    form_data.append('filename', file.name);
    var reader = new FileReader();

    reader.onloadend = function (ev) {
      thumb.attr('src', reader.result);
      var tempImg = new Image();
      tempImg.src = reader.result;

      tempImg.onload = function (e) {
        var MAX_WIDTH = 1600;
        var MAX_HEIGHT = 1200;
        var tempW = tempImg.width;
        var tempH = tempImg.height;

        if (tempW > tempH) {
          if (tempW > MAX_WIDTH) {
            tempH *= MAX_WIDTH / tempW;
            tempW = MAX_WIDTH;
          }
        } else {
          if (tempH > MAX_HEIGHT) {
            tempW *= MAX_HEIGHT / tempH;
            tempH = MAX_HEIGHT;
          }
        }

        var canvas = document.createElement('canvas');
        canvas.width = tempW;
        canvas.height = tempH;
        var ctx = canvas.getContext("2d");
        console.log('tempW and tempH ' + tempW + ' ' + tempH);
        ctx.drawImage(this, 0, 0, tempW, tempH);
        var dataURL = canvas.toDataURL("image/jpeg"); //form_data.append('image', dataURL);

        form_data.append('image', dataURL);
        document.getElementById('output').src = dataURL; //each time an ajax request is made cpt is increased
        //will be decreased on complete

        cpt += 1;
        $.ajax({
          dataType: 'json',
          type: 'POST',
          data: form_data,
          url: "filemanager/manage",
          processData: false,
          contentType: false,
          xhr: function (_xhr) {
            function xhr() {
              return _xhr.apply(this, arguments);
            }

            xhr.toString = function () {
              return _xhr.toString();
            };

            return xhr;
          }(function () {
            xhr = new window.XMLHttpRequest(); //new

            xhr.upload.addEventListener('progress', function (e) {
              if (e.lengthComputable) {
                percent = e.loaded / e.total * 100;
                console.log("percent is " + percent);
                $row.find('.progress').css('width', (percent | 0) + '%');
              }
            }); // on load remove the progress bar

            xhr.upload.onload = function () {
              $row.remove();
            }; // return the customized object


            return xhr;
          }),
          success: function success(data) {
            // console.log('success decreasing cpt ' + cpt + '--' + data['message']);
            if (cpt > 0) {
              cpt -= 1;
            } // console.log(data['message']);

          },
          error: function error(request, status, errorThrown) {
            if (cpt > 0) {
              cpt -= 1;
            }

            alert('error dans upload and resize: ' + errorThrown + '  !!S');
          },
          complete: function complete(request, status) {
            //when all uploads are over
            //console.log('complete ' + cpt);
            if (cpt === 0) {
              $('#fmg_upload_progress').fadeOut(4000);
              $('#fmg_file_form').fadeIn(8000);
              $('.custom-file-label').html('');
              filemanager.list(current_dir);
            }

            filemanager.list(current_dir);
          }
        });
      };
    };

    reader.readAsDataURL(file); //reader.readAsBinaryString(file);
  },
  //from SYMFONY######################################################################
  resizeAndUpload: function resizeAndUpload(file) {
    var $row = filemanager.renderFileUploadRow(file, current_dir);
    var action_url = $('#actionUrl').html(); //the thumbnail in the upload line

    var thumb = $('img', $row);
    $('#fmg_upload_progress').append($row);
    $row.find('.progress').css('width', 0 + '%');
    var form = $("#fmg_file_form");
    var form_data = new FormData();
    form_data.append('to_do', 'upload_resize'); //form_data.append('file_data', file);//file is not required with resize

    form_data.append('folder', current_dir);
    form_data.append('filename', file.name);
    var reader = new FileReader();

    reader.onloadend = function (readerEvent) {
      thumb.attr('src', reader.result);
      var tempImg = new Image();
      tempImg["with"] = 1200;

      tempImg.onload = function (e) {
        var MAX_WIDTH = 1600;
        var MAX_HEIGHT = 1200;
        var tempW = tempImg.width;
        var tempH = tempImg.height;

        if (tempW > tempH) {
          if (tempW > MAX_WIDTH) {
            tempH *= MAX_WIDTH / tempW;
            tempW = MAX_WIDTH;
          }
        } else {
          if (tempH > MAX_HEIGHT) {
            tempW *= MAX_HEIGHT / tempH;
            tempH = MAX_HEIGHT;
          }
        }

        var canvas = document.createElement('canvas');
        canvas.width = tempW;
        canvas.height = tempH;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(tempImg, 0, 0, tempW, tempH);
        var dataURL = canvas.toDataURL("image/jpeg", 1.0);
        form_data.append('image', dataURL); //each time an ajax request is made cpt is increased
        //will be decreased on complete

        cpt += 1;
        $.ajax({
          dataType: 'json',
          type: 'post',
          data: form_data,
          url: "/filemanager/manage",
          processData: false,
          contentType: false,
          xhr: function (_xhr2) {
            function xhr() {
              return _xhr2.apply(this, arguments);
            }

            xhr.toString = function () {
              return _xhr2.toString();
            };

            return xhr;
          }(function () {
            xhr = new window.XMLHttpRequest(); //new

            xhr.upload.addEventListener('progress', function (e) {
              if (e.lengthComputable) {
                percent = e.loaded / e.total * 100;
                console.log("percent is " + percent);
                $row.find('.progress').css('width', (percent | 0) + '%');
              }
            }); // on load remove the progress bar

            xhr.upload.onload = function () {
              $row.remove();
            }; // return the customized object


            return xhr;
          }),
          success: function success(data) {
            // console.log('success decreasing cpt ' + cpt + '--' + data['message']);
            if (cpt > 0) {
              cpt -= 1;
            }
          },
          error: function error(request, status, errorThrown) {
            if (cpt > 0) {
              cpt -= 1;
            }

            alert('error : ' + errorThrown + '  !!S');
          },
          complete: function complete(request, status) {
            //when all uploads are over
            //console.log('complete ' + cpt);
            if (cpt === 0) {
              $('#fmg_upload_progress').fadeOut(4000);
              $('#fmg_file_form').fadeIn(8000);
              $('.custom-file-label').html('');
              filemanager.list(current_dir);
            }

            filemanager.list(current_dir);
          }
        });
      };

      tempImg.src = readerEvent.target.result;
    };

    reader.readAsDataURL(file); //reader.readAsBinaryString(file);
  },
  //not used at the moment
  //upload the file without resizing
  // if resizing is necessary, please use
  // resizeAndUpload
  uploadFile: function uploadFile(file) {
    var $row = filemanager.renderFileUploadRow(file, current_dir);
    var action_url = $('#actionUrl').html();
    filemanager.createThumbnail(file, $row);
    $('#fmg_upload_progress').append($row);
    $row.find('.progress').css('width', 0 + '%');
    var form = $("#fmg_file_form");
    var form_data = new FormData();
    form_data.append('to_do', 'upload_resize');
    form_data.append('file_data', file);
    form_data.append('folder', current_dir);
    $.ajax({
      dataType: 'json',
      type: 'post',
      url: "filemanager/manage",
      data: form_data,
      processData: false,
      contentType: false,
      xhr: function xhr() {
        // get the native XmlHttpRequest object
        var xhr = $.ajaxSettings.xhr(); // set the onprogress event handler

        xhr.upload.onprogress = function (e) {
          //xhr.upload.addEventListener('progress', function(e) {
          if (e.lengthComputable) {
            percent = e.loaded / e.total * 100;
            $row.find('.progress').css('width', e.loaded / e.total * 100 + '%');
            console.log("percent is : " + percent);
          } else {
            console.log("progress non computable");
          }
        }; // set the onload event handler


        xhr.upload.onload = function () {
          console.log(xhr.response);
          $row.remove();
          filemanager.list(current_dir);
        }; // return the customized object


        return xhr;
      },
      success: function success(data) {
        alert('success in uploading');
        console.log(data);

        if (cpt > 0) {
          cpt -= 1;
        }
      },
      error: function error(request, status, errorThrown) {
        alert('error : ' + errorThrown + '!!S');
      },
      complete: function complete(request, status) {
        if (cpt === 0) {
          $('#fmg_upload_progress').fadeOut(4000);
          $('#fmg_file_form').fadeIn(4000);
        }
      }
    });
  },
  //create a dir whose name is defined by user
  //in the name input 
  createDir: function createDir(current_dir, new_dir) {
    console.log('in createDir current_dir is ' + current_dir + ' new_dir is ' + new_dir);
    $.trim(new_dir);

    if (new_dir === '') {
      alert('Vous devez donner un nom au dossier à créer !');
      return;
    }

    var url = "/filemanager/manage";
    $.ajax({
      type: 'POST',
      url: url,
      data: {
        to_do: 'mkdir',
        current_dir: current_dir,
        new_dir: new_dir
      },
      dataType: 'json',
      success: function success(data) {
        if (data.success === false) {
          alert(data.message);
        }

        $('#fmg_dirname').val('');
        filemanager.list(current_dir);
      }
      /*  error: function(request, status, errorThrown) {
          alert('error : ' + errorThrown + '!!S');
      },
      complete: function(request, status) {
          //alert(status);
      }
      */

    });
    console.log('at the end of createDir');
  },
  deleteFile: function deleteFile(filename) {
    $.ajax({
      dataType: 'json',
      type: 'post',
      url: "/filemanager/manage",
      data: {
        to_do: 'delete',
        filename: filename
      },
      success: function success(data) {
        if (data.vide === false) {
          alert(data.message);
        }

        filemanager.list(current_dir);
      },
      error: function error(request, status, errorThrown) {
        alert('error : ' + errorThrown + '!!S');
      },
      complete: function complete(request, status) {//alert(status);
      }
    });
  },
  //not used if resizing is in use
  //check image size
  checkValidity: function checkValidity(file) {
    var ft = file.type;
    var ft = ft.slice(ft.lastIndexOf('/') + 1);

    if ($.inArray(ft, accepted_types) !== -1) {
      if (file.size > MAX_FILE_SIZE) {
        return [false, file.name + ': la taille de ce fichier dépasse la limite autorisée.'];
      }

      return [true];
    } else {
      console.log('return false');
      return [false, file.name + ': ce type de fichier n\'est pas accepté.'];
    }
  },
  list: function list(current_dir) {
    console.log("in list function");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    rowNumber = 0;
    $('.delete_selection').addClass('fmg_hide'); //var action_url = $('#actionUrl').html();
    //var action_url="{{ route('ajaxRequest.post') }}";

    var action_url = 'filemanager';
    console.log("action_url is " + action_url);
    console.log("in list function current_dir is " + current_dir);
    console.log(action_url);
    $.ajax({
      dataType: 'json',
      type: 'POST',
      url: "/filemanager/manage",
      data: {
        to_do: 'list',
        dir: current_dir
      },
      success: function success(data) {
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
      error: function error(request, status, errorThrown) {
        alert('error from list function: ' + errorThrown + '!!S');
      },
      complete: function complete(request, status) {
        //alert(status);
        $('#fmg_upload_progress').fadeOut(10); //console.log('current_dir is : ' + current_dir);

        $("#fmg_preview").hide();
      }
      /* */

    });
  }
};
/*DEBUT DU SCRIPT */

/*IMPORTANT NOTICE the images are stored into the directory named strorage/photos under the public directory
to access the images in a view we must use the route /private of the PrivateController
*/

var rowNumber = 0;
$('#logo').css('height', '80px');
var current_dir = $('#userBaseDir').html(); //privacy is the private folder of the user under the upload directory

var priv = current_dir.split('/');
var privacy = priv[priv.length - 1];
console.log('privacy is ' + privacy);

if (privacy != "admin") {
  privacy = "admin/" + privacy;
} //console.log("privacy is " + privacy);


var webRelativeUploadDirectory = "/../../private"; //console.log('web rel route is ' + webRelativeUploadDirectory);

var ar = current_dir.split('/');
var username = ar[ar.length - 1]; //console.log("username is " + username);

var xsrf = $("#xsrf").html();
var accepted_types = ['jpeg'];
var MAX_FILE_SIZE = 800000;
var cpt = 0;
var selection;
var isDownKey = [];
var selectedRows = [];
var lastSelectedRow = undefined;
$(document).ready(function () {
  filemanager.list(current_dir);
  console.clear();
  $('#fmg_btn_mkdir').click(function (event) {
    event.preventDefault();
    event.stopPropagation();
    new_dir = $('#fmg_dirname').val(); //console.log('click sur boutont créer ' + new_dir);

    var url = '/filemanager/testajax';
    filemanager.createDir(current_dir, new_dir);
  }); //délégation d'événement sur élément ajouté en dynamique

  $("#fmg_listing").on("click", ".name", function () {
    current_dir += '/' + $(this).html();
    filemanager.list(current_dir);
  }); //délégation d'événement sur action delete d'élément ajouté en dynamique

  $('#fmg_listing').on('click', '.delete', function (event) {
    filemanager.deleteFile($(this).attr('data_file'));
  }); //délégation d'événement sur élément du breadcrumb

  $("#fmg_breadcrumb").on("click", "span.bc_element", function () {
    var next_dir = '';
    var choice = $(this);
    var spans = $("#fmg_breadcrumb span.bc_element").each(function (index) {
      if ($(this).attr('id') > choice.attr('id')) {
        return false;
      }

      next_dir += $(this).html() + '/';
    });
    current_dir = $('#userBaseDir').html() + '/' + next_dir;
    filemanager.list(current_dir);
  }); //MULTIPART FILE INPUT DISPLAY SELECTION

  $('#fmg-multiple-input').change(function (e) {
    //write the selected file names in the label
    var files = [];

    for (var i = 0; i < $(this)[0].files.length; i++) {
      file = $(this)[0].files[i];
      files.push(file.name); //filemanager.resizeAndUpload(input.files[i]);
    }
  }); //MULTIPART FILE INPUT UPLOAD

  if (window.File && window.FileReader && window.FileList && window.Blob) {
    $(document).on('click', '.btn-upload', function (e) {
      e.preventDefault();
      $("#fmg_upload_progress").show().empty();
      $('#fmg_file_form').fadeOut(10); //var input = $("#fmg-multiple-input").get(0);//a jQuery selector doesn't return a DOM element but a jQuery object

      var input = document.getElementById('fmg-multiple-input'); //equivalent return the DOM element

      for (var i = 0; i < input.files.length; i++) {
        console.log(input.files[i]);
        filemanager.resizeAndUpload(input.files[i]); //filemanager.uploadFile(input.files[i]);
      }

      $("#fmg-form").trigger("reset");
    });
  } else {
    alert('The File APIs are not fully supported in this browser.');
  }

  $(window).keydown(function (e) {
    var x = e.keyCode;
    isDownKey[x] = true; //console.log('down' + e.keyCode);
  });
  $(window).keyup(function (e, rowNumber) {
    var x = e.keyCode;
    isDownKey[x] = false; //console.log('up ' + e.keyCode);

    rowNumber = $('#rowNumber').html();

    if (e.keyCode === 40 && lastSelectedRow) {
      var n = parseInt(lastSelectedRow) + 1;

      if (n < rowNumber) {
        if ($("tr[id=" + n + "]")) {
          filemanager.manageSelection($("tr[id=" + n + "]"));
        }
      }
    }

    if (e.keyCode === 38) {
      var n = parseInt(lastSelectedRow) - 1;
      console.log('n = ' + n);

      if (n >= 0) {
        if ($("tr[id=" + n + "]")) {
          filemanager.manageSelection($("tr[id=" + n + "]"));
        }
      }
    }
  });
  $('#fmg_table').on('click', 'tr', function () {
    if (isDownKey[16]) {
      console.log('shif is down');
    }

    if (isDownKey[17]) {
      console.log('ctrl is down');
    }

    if (isDownKey[18]) {
      console.log('alt is down');
    }

    filemanager.manageSelection($(this));
  });
  $('.delete_selection').click(function () {
    filemanager.deleteSelection();
  });
  /**/
});

/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/js/filemanager.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /ORIGINAL-P1/LARAVEL/denentzat/resources/js/filemanager.js */"./resources/js/filemanager.js");


/***/ })

/******/ });