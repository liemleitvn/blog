import Request from '../requests/Request'
export default class UserHandle {
    constructor() {
        this.role =document.getElementsByClassName('role-in-user');
    }

    init() {
        for(let i = 0; i < this.role.length; i++) {
            let data = this.role[i].getAttribute('data-id');
            this.role[i].addEventListener('click',()=>this.deleteRoleOnUser(data))
        }
    }

    async deleteRoleOnUser(id) {
        let _token ='';
        const metas = document.getElementsByTagName('meta');
        for (let i = 0; i<metas.length; i++) {
            if(metas[i].getAttribute('name') ==='csrf-token') {
                _token = metas[i].getAttribute('content');
            }
        }
        
        let tmp = id.split('-');
        let data = {
            user_id: parseInt(tmp[0]),
            role_id: parseInt(tmp[1])
        };

        let url = 'http://blog.local/admin/users/delete/role-user';
        let opts = {
            mode: 'no-cors',
            credentials: "same-origin",
            body: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': _token
            }
        };
        let result = await Request.send(url,opts);

        console.log(result);
    }
}