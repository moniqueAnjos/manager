function factoryEmployees() {
    let employee = {};
    let url = 'employee';
    employee.id = '';
    employee.name = '';
    employee.email = '';
    employee.telephone = '';
    employee.gender = '';

    async function index() {
        result = [];
        let response = await axios.get(url + 'All')
            .then(function(response) {
                result = response;
            });
        return result;
    }

    async function remove() {
        let response = await axios.delete(url + '/' + this.id)
            .then(function(response) {
                return response;
            })
            .catch(function(error) {
                return error;
            });
        return response;
    }
    async function getEmployee() {
        let response = await axios.get(url + '/' + this.id)
            .then(function(response) {
                return response;
            })
            .catch(function(error) {
                return error;
            })
        return response;
    }

    async function newEmployee() {
        let response = await axios.post(url, this)
            .then(function(response) {
                return response;
            })
            .catch(function(error) {
                return error;
            })
        return response;
    }
    async function changeEmployee() {
        let response = await axios.put(url + '/' + this.id, this)
            .then(function(response) {
                return response;
            })
            .catch(function(error) {
                return error;
            })
        return response;
    }

    employee.newEmployee = newEmployee;
    employee.getEmployee = getEmployee;
    employee.changeEmployee = changeEmployee;
    employee.index = index;
    employee.delete = remove;
    return employee;
}