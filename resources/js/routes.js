let saveemployee = require('./components/AdminEnd/save_employee.vue').default
let editemployee = require('./components/AdminEnd/save_employee.vue').default
let adminhome = require('./components/AdminEnd/index.vue').default
let save_company = require('./components/AdminEnd/save_company.vue').default
let viewcompany = require('./components/AdminEnd/companies.vue').default
let viewemployee = require('./components/AdminEnd/employees.vue').default
let editcompany = require('./components/AdminEnd/save_company.vue').default


let PageNotFound = require('./components/PageNotFound.vue').default

export const routes = [
    ///user side routes

    { path: '/view-employee', name: '/view-employee', component: viewemployee },
    { path: '/save-employee', name: '/save-employee', component: saveemployee },
    { path: '/edit-employee/:employee_id', name: 'edit-employee', component: editemployee },
    { path: '/home', name: '/home', component: adminhome },

    { path: '/save-company', name: '/save-company', component: save_company },
    { path: '/view-company', name: '/view-company', component: viewcompany },

    { path: '/edit-company/:company_id', name: 'edit-company', component: editcompany },
    {
        path: '*',

        component: PageNotFound
    },
    //end of user side routes



]