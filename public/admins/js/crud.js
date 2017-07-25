var BIGK;
if(!BIGK){
    var BIGK = {};
}

if(!BIGK.crud){
    BIGK.crud = {};
}

(function(){
    var func = BIGK.crud;

    func.insertRecord = function(route, data, csrfToken, callback){

    };

    func.getRecord = function(){

    };

    func.getAllRecord = function(){

    };

    func.updateRecord = function(){

    };

    func.deleteRecord = function(route, data, csrfToken, callback){

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this later",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        },function(){
            $.ajax({
                url: route,
                type: "DELETE",
                data: data,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                error: function(err){
                    swal({
                        title: "Oop! Something went wrong",
                        text: err,
                        type: "error",
                        allowOutsideClick: true,
                    });
                    console.log(err);
                },
                success: function(res){
                    if(res.status == 200){
                        swal({
                            title: "Succeed Confirmation",
                            text: res.success.message,
                            type: "success",
                            timer: 2500,
                            allowOutsideClick: true,
                        });
                        callback();
                    }else{
                        swal({
                            title: "Oop! Something went wrong",
                            text: res.error.message,
                            type: "error",
                            allowOutsideClick: true,
                        });
                    }
                }
            });
        });
    };

    func.upload = function(route, data, csrfToken, callback){
        this.route = route;
        this.data = data;
        this.csrfToken = csrfToken;
        this.callback = function(res){
            callback(res);
        };
        console.log(this.data);
    };

    func.upload.prototype.startUpload = function(){
        var self = this;
        $.ajax({
            url: self.route,
            data: self.data,
            dataType: 'JSON',
            type: 'POST',
            enctype: 'multipart/form-data',
            xhr: function(){
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', self.progressHandling, false);
                }
                return myXhr;
            },
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': self.csrfToken,
            },
            error: function(err){
                swal({
                    title: 'Oop! Something went wrong',
                    text: err,
                    type: 'error',
                    timer: 5000,
                    allowOutsideClick: true,
                });
            },
            success: function(res){
                self.callback(res);
            }
        });
    };

    func.upload.prototype.progressHandling = function(event){
        var percent = 0;
        var position = event.loaded || event.position;
        var total = event.total;
        var progress_bar_id = "#progressbar-wrap";
        if (event.lengthComputable) {
            percent = Math.ceil(position / total * 100);
        }
        // update progressbars classes so it fits your code
        $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
        $(progress_bar_id + " .status").text(percent + "%");
    };

})();
