const DONE = 200;
const ERROR = 500;

var request = {
    post: function (url, params) {
        return this.send(url, 'post', params);
    },

    get: function (url, params) {
        return this.send(url, 'get', {params: params});
    },

    send: function (url, method, params) {
        return new Promise(function (resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded; charset=UTF-8");
            xhr.setRequestHeader('X-Compress', null);
            xhr.onload = function () {
                if (this.status === DONE) {
                    resolve(this.response);
                }
                if (this.status === ERROR) {
                    reject(this.response);
                }
            };

            xhr.onerror = function () {
                reject(new Error("Network Error"));
            };

            xhr.send(params);
        });
    },
};
//
// function sendPostRequest(params) {
//     return new Promise((resolve, reject) => {
//         request.post(processes.handlerUrl, params).then(resolve, (error) => {
//             reject(error);
//         });
//     });
// }