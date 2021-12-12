import Token from './Token';
import AppStorage from './AppStorage';

class User {

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const username = res.data.name;

        if (Token.isvalid(access_token)) {
            AppStorage.store(access_token, username);
            return true;
        }
        return false;

    }
    hasToken() {
        const storeToken = localStorage.getItem('token');
        if (storeToken) {
            return Token.isvalid(storeToken) ? true : false;
        } else {
            return false;
        }
    }
    loggedIn() {
        return this.hasToken();
    }
    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }
    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
        return false;
    }
    logout() {
        return AppStorage.clear() ? true : false;
    }
}
export default User = new User();