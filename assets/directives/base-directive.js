app.directive('fileModel', ['$parse', function ($parse)
{
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var isMultiple = attrs.multiple;
            var isName = attrs.name;
            var modelSetter = model.assign;
            element.bind('change', function()
            {
                console.log("isName:"+isMultiple);
                var values = [];
                angular.forEach(element[0].files, function (item) {
                    var value = {
                        // File Name
                        name: item.name,
                        //File Size
                        size: item.size,
                        name1:isName,
                        //File URL to view
                        url: URL.createObjectURL(item),
                        // File Input Value
                        _file: item
                    };
                    values.push(value);
                });
                scope.$apply(function ()
                {
                    if (isMultiple) {
                        modelSetter(scope, values);
                    } else {
                        modelSetter(scope, element[0].files[0]);
                    }
                });
            });
        }
    };
}])
.directive('onlyDigits',function()
{
    return {
        restrict: 'AE',
        require: '?ngModel',
        link: function (scope, element, attrs, modelCtrl)
        {
            modelCtrl.$parsers.push(function (inputValue)
            {
                if (inputValue == undefined) return '';
                var transformedInput = inputValue.replace(/[^0-9]/g, '');
                if (transformedInput !== inputValue) {
                    modelCtrl.$setViewValue(transformedInput);
                    modelCtrl.$render();
                }
                return transformedInput;
            });
        }
    };
})


/*.directive('fileModel', ['$parse', function ($parse)
    {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var isMultiple = attrs.multiple;
                var modelSetter = model.assign;
                element.bind('change', function()
                {
                    var values = [];
                    angular.forEach(element[0].files, function (item) {
                        var value = {
                            // File Name
                            name: item.name,
                            //File Size
                            size: item.size,
                            //File URL to view
                            url: URL.createObjectURL(item),
                            // File Input Value
                            _file: item
                        };
                        values.push(value);
                    });
                    scope.$apply(function () {
                        if (isMultiple) {
                            modelSetter(scope, values);
                        } else {
                            modelSetter(scope, values[0]);
                        }
                    });
                });
            }
        };
    }])
*/
.directive('confirmPwd',['$interpolate', '$parse', function($interpolate, $parse)
{
    return {
        require: 'ngModel',
        link: function(scope, elem, attr, ngModelCtrl)
        {
            var pwdToMatch = $parse(attr.confirmPwd);
            var pwdFn = $interpolate(attr.confirmPwd)(scope);

            scope.$watch(pwdFn, function(newVal) {
                ngModelCtrl.$setValidity('password', ngModelCtrl.$viewValue == newVal);
            })

            ngModelCtrl.$validators.password = function(modelValue, viewValue) {
                var value = modelValue || viewValue;
                return value == pwdToMatch(scope);
            };
        }
    }
}])
.directive('ckEditor', function () {
    return {
        require: '?ngModel',
        link: function (scope, elm, attr, ngModel) {
            var ck = CKEDITOR.replace(elm[0]);
            if (!ngModel) return;
            ck.on('instanceReady', function () {
                ck.setData(ngModel.$viewValue);
            });
            function updateModel() {
                scope.$apply(function () {
                    ngModel.$setViewValue(ck.getData());
                });
            }
            ck.on('change', updateModel);
            ck.on('key', updateModel);
            ck.on('dataReady', updateModel);

            ngModel.$render = function (value) {
                ck.setData(ngModel.$viewValue);
            };
        }
    };
})


    .directive('filenameModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.filenameModel);
                var modelSetter = model.assign;

                element.bind('change', function () {

                //    var values = [];

                    scope.$apply(function () {
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };

    }])


    .directive('imgUpload',['$rootScope',function(rootScope){
        return	{
            restrict: 'A',
            link: function (scope, elem, attrs)		{
            var canvas = document.createElement("canvas");
            var extensions = 'jpeg ,jpg, png, gif';
            elem.on('change', function ()			{
                reader.readAsDataURL(elem[0].files[0]);
                var filename = elem[0].files[0].name;
                var extensionlist = filename.split('.');
                var extension =extensionlist[extensionlist.length - 1];
                if(extensions.indexOf(extension) == -1)				{
                    alert("File extension , Only 'jpeg', 'jpg', 'png', 'gif', 'bmp' are allowed.");
                }else{
                    scope.file = elem[0].files[0];
                    scope.aoorg_logo_name = filename;
                }});
            var reader = new FileReader();
            reader.onload = function (e){
                scope.aoorg_logo = e.target.result;
                scope.$apply();
            }
        }
        }}]);




