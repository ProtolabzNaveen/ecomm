import React, { useState } from 'react';
import api from './api';

const Register = () => {
    const [formData, setFormData] = useState({ name: '', email: '', password: '' });
    const [response, setResponse] = useState(null);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const res = await api.post('/register', formData);
            setResponse(res.data);
        } catch (error) {
            console.error(error);
            setResponse(error.response.data);
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <input name="name" placeholder="Name" onChange={handleChange} />
            <input name="email" placeholder="Email" onChange={handleChange} />
            <input name="password" placeholder="Password" onChange={handleChange} type="password" />
            <button type="submit">Register</button>
            {response && <pre>{JSON.stringify(response, null, 2)}</pre>}
        </form>
    );
};

export default Register;
