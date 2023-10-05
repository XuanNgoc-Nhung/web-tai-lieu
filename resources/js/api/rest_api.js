import axios from 'axios';
import {
    authHeader
} from './auth-header'

export default {
    DEFAULT_TIME_OUT: 60000,
    async post(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = '';
        let tm = timeout;
        var time = this.makeid(8) + '-' + Date.now()
        console.log("POST " + url);
        console.log("req = " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        let result = ''
        await axios.post(uri, params, config).then((response) => {
            result = response
        }).catch((e) => {
        })
        return result

    },
    async put(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        var time = this.makeid(8) + '-' + Date.now()
        console.log("PUT " + url);
        console.log("req = " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'PUT',
            url: uri,
            data: params
        })
        await axios.put(uri, params, config).then((response) => {
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((e) => {
            result.data = e.response;
            result.rc = 1;
            result.msg = 'Thất bại'
            let abc = JSON.stringify(e.response)
            window.postMessage(abc, "*");
        })

        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result.data
        })
        return result
    },
    async patch(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        var time = this.makeid(8) + '-' + Date.now()
        console.log("patch url: " + url);
        console.log("patch params: " + JSON.stringify(params));
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let uri = baseUri + url;
        let result = null
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'PATCH',
            url: uri,
            data: params
        })
        await axios.patch(uri, params, config).then((response) => {
            result = response
        }).catch((error) => {
            result = error.response
            let abc = JSON.stringify(error.response)
            window.postMessage(abc, "*");
        })
        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result
        })
        return result
    },
    async patchHandShake(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        var time = this.makeid(8) + '-' + Date.now()
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'x-sophie-request-timestamp': params.timestampReq,
                'x-sophie-signature': params.signature
            }
        };
        let uri = baseUri + url;
        let result = null
        let bodySend = JSON.stringify(params.body)
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'PATCH',
            url: uri,
            data: params
        })
        await axios.patch(uri, bodySend, config).then((response) => {
            result = response
        }).catch((error) => {
            result = error.response
        })
        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result
        })
        return result
    },
    get(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;

        var time = this.makeid(8) + '-' + Date.now()
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'GET',
            url: uri,
            data: params
        })
        return axios.get(uri, config)

    },
    async getData(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        var time = this.makeid(8) + '-' + Date.now()
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'GET',
            url: uri,
            data: params
        })
        await axios.get(uri, config).then((response) => {
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((e) => {
            result.data = e.response;
            result.rc = 1;
            result.msg = 'Thất bại'
            let abc = JSON.stringify(e.response)
            window.postMessage(abc, "*");
        })
        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result.data
        })
        return result

    },
    async getNoDecryptData(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        var result = ''

        var time = this.makeid(8) + '-' + Date.now()
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'GET',
            url: uri,
            data: params
        })
        await axios.get(uri, config).then((response) => {
            result = response
        }).catch((e) => {
            result = e.response;
            let abc = JSON.stringify(e.response)
            window.postMessage(abc, "*");
        })
        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result
        })
        return result

    },
    async delete(url, params, timeout = this.DEFAULT_TIME_OUT) {
        let baseUri = BASE_URL_API;
        let tm = timeout;
        let config = {
            timeout: tm,
            headers: authHeader()
        };
        let query = this.objectToQueryString(params);
        let uri = baseUri + url + "?" + query;
        var result = {
            rc: null,
            msg: '',
            data: {}
        }
        var time = this.makeid(8) + '-' + Date.now()
        this.saveLog({
            type: 'REQUEST',
            idReq: time,
            method: 'DELETE',
            url: uri,
            data: params
        })
        console.log('xoá')
        await axios.delete(uri, config).then((response) => {
            console.log('12')
            var data = util.decryptData(response.data, uri)
            result.data = data;
            result.rc = 0;
            result.msg = 'Thành công'
        }).catch((error) => {
            result.data = error.response;
            result.rc = 1;
            result.msg = 'Thất bại'
            let abc = JSON.stringify(error.response)
            window.postMessage(abc, "*");
        })
        this.saveLog({
            type: 'RESPONSE',
            idReq: time,
            res: result.data
        })
        return result

    },
    makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    },
    saveLog(data) {
        axios.post('save-log', data)
    },
    objectToQueryString(obj) {
        let str = [];
        for (let p in obj)
            if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            }
        return str.join("&");
    },
    onSuccess(response, url, success) {
        if (url !== undefined && LIST_URL_KEY_DEFAULT.indexOf(url) === -1) {
            var dataResponse = Utils.decryptData(response.data, url)
            Logs.json("Success decrypt for '" + url + "'", dataResponse)
            success(dataResponse)
        } else {
            Logs.json("Success not decrypt for '" + url + "'", response.data)
            success(response.data)
        }
    },
}
