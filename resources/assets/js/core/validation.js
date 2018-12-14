export class Validation {
    constructor (object) {
        if (object === undefined) {
            throw "[ERROR](Validation) Object is empty";
        } 

        this.requirements = object;
        this.error = undefined;
    }


    static create(object) {
        const property = {
            get value () {
                return this.__proto__._value;
            },
            set value (new_value) {
                this.__proto__._value = new_value;

                property.__proto__._valid = this.__proto__._validation.validate_value(new_value);

                if (property.__proto__._valid) {
                    this.__proto__._error = undefined;
                }
            },
            get isValid () {
                return this.__proto__._valid;
            },
            get error() {
                return this.__proto__._error;
            }
        };

        property.__proto__._validation = new Validation(object);
        property.__proto__._value = undefined;
        property.__proto__._error = undefined;
        property.__proto__._valid = undefined;

        return Object.seal(property);
    }

    validate_value(value) {
        

        const requirements = Object.keys(this.requirements);
        let is_valid = true;

        for (let i = 0; i < requirements.length; i++) {
            const requirement_key = requirements[i];
            const requirement_value = this.requirements[requirement_key];

            if (requirement_key === "type") {
                switch (requirement_value) {
                    case 0: 
                        if (typeof value !== "string") {
                            is_valid = false;
                            this.error = ["type", "string"];
                        }
                        break;
                    case 1:
                        if (typeof value !== "number") {
                            is_valid = false;
                            this.error = ["type", "number"];
                        }
                        break;
                    case 2: 
                        if (!this.is_email(value)) {
                            is_valid = false;
                            this.error = ["type", "email"];
                        }
                        break;
                }
            }

            if (requirement_key === "length") {
                switch (typeof requirement_value) {
                    case "function": 
                        const length = requirement_value(value);

                        if (length === 1) {
                            this.error = ["length", "big" , requirement_value.prototype.values()];
                            is_valid = false;
                        } else if (length === -1) {
                            this.error = ["length", "small" , requirement_value.prototype.values()];
                            is_valid = false;
                        }
                        
                        break;
                }
            }

            if (requirement_key === "required") {
                if (requirement_value === true) {
                    if (value === "") {
                        this.error = ["required", "empty"];
                        is_valid = false;
                    }
                }
            }
        }
        
        this.requirements.__proto__._error = this.error;

        return is_valid;
    }

    is_email(email) {
        const email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return email_regex.test(email.toLowerCase());
    }
};

export class Validations {
    constructor (object) {
        const validations = {};

        const keys = Object.keys(object);
        for (let i = 0; i < keys.length; i++) {
            validations[keys[i]] = Validation.create(object[keys[i]]);
        }   

        return validations;
    }
}

window.validation = Validation;

export const types = {
    "string": 0,
    "number": 1,
    "email": 2
}

export const required = true;

export function between (min, max) {
    function between_validation (_value) {
        let value = _value;

        if (typeof _value === "string") {
            value = _value.length;
        }

        if (value < min) {
            return -1;
        } else if (value > max) {
            return 1;
        } else {
            return 0;
        }
    }

    between_validation.prototype.values = () => {
        return { min: min, max: max }
    }

    return between_validation;
}