import axios from 'axios';
import React, { useState } from 'react';

const RegistrarPaciente = () => {
    const [nombre, setNombre] = useState('');
    const [ApPat, setApPat] = useState('');
    const [ApMat, setApMat] = useState('');
    const [tele, setTele] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();
        
        const pacienteData = {
            nombre: nombre,
            ApPat: ApPat,
            ApMat: ApMat,
            tele: tele,
            email: email,
            password: password,
        };

        try {
            const response = await axios.post('http://localhost:8000/api/paciente/guardar', pacienteData);
            alert(response.data.message);
        } catch (error) {
            console.error('Error registrando paciente:', error);
            alert('Error registrando paciente');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <input type="text" value={nombre} onChange={(e) => setNombre(e.target.value)} placeholder="Nombre" required />
            <input type="text" value={ApPat} onChange={(e) => setApPat(e.target.value)} placeholder="Apellido Paterno" required />
            <input type="text" value={ApMat} onChange={(e) => setApMat(e.target.value)} placeholder="Apellido Materno" required />
            <input type="text" value={tele} onChange={(e) => setTele(e.target.value)} placeholder="Teléfono" required />
            <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="Email" required />
            <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="Contraseña" required />
            <button type="submit">Registrar Paciente</button>
        </form>
    );
};

export default RegistrarPaciente;
