import User from './User';

class Exception {
    handle(error) {
        this.isExpired(error.response.data.error)
    }

    isExpired(error) {
        if (error == "Token is can't be used. Get new one.") {
            User.logout();
        }
    }
}

export default Exception = new Exception()