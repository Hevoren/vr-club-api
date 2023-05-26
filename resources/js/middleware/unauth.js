import  store from "../store/modules/auth.js"
const unauth = (to, from, next) => {
    if (!localStorage.getItem('bearer')) {
        // Если пользователь аутентифицирован, разрешите доступ к маршруту
        next();
    } else {
        // Если пользователь не аутентифицирован, перенаправьте его на страницу входа
        next({ name: "main" });
    }
};

export default unauth;
