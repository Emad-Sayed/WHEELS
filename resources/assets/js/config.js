export const apiDomain="http://localhost:8000"
export const loginURL="api/login"
export const registURL="api/register"
export const userURL="api/details"
export const GetHeaders =function () {
    const token=window.localStorage.getItem("token")
    const headers={
        'Accept':'application/json',
        'Content-Type':'application/x-www-form-urlencoded',
        'Authorization':'Bearer '+token

    }
    return headers
}
export const GetFileSubmitHeaders =function () {
    const token=window.localStorage.getItem("token")
    const headers={
        'Accept':'application/json',
        'Content-Type':'application/x-www-form-urlencoded',
        'Authorization':'Bearer '+token,
        'Content-Type': 'multipart/form-data'

    }
    return headers
}
export const isSet =function () {
    if(window.localStorage.getItem('token')===null)
        return false
    return true
}
export const isAdmin =function () {
    if(isSet()){
        let user=JSON.parse(window.localStorage.getItem('user'))
        if(user.type_id==1){
            return true
        }
    }
    return false;
}