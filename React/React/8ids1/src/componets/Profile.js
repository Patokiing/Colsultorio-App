import React, { useEffect, useState } from 'react';
import axios from 'axios';
import styles from './Profile.module.css'; // Importando el CSS Module

const Profile = () => {
    const [paciente, setPaciente] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [editing, setEditing] = useState(false);
    const [formData, setFormData] = useState({});
    const [successMessage, setSuccessMessage] = useState('');

    useEffect(() => {
        const token = localStorage.getItem("token");

        if (!token) {
            setError("No estás autenticado.");
            setLoading(false);
            return;
        }

        axios.get('http://127.0.0.1:8000/api/paciente/data', {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json'
            }
        })
        .then(response => {
            setPaciente(response.data.paciente);
            setFormData({
                nombre: response.data.paciente.nombre,
                ap_paterno: response.data.paciente.ap_paterno,
                ap_materno: response.data.paciente.ap_materno,
                telefono: response.data.paciente.telefono,
                email: response.data.paciente.email
            });
            setLoading(false);
        })
        .catch(error => {
            console.error('Error al obtener los datos del paciente:', error);
            setError('No se pudieron cargar los datos del paciente.');
            setLoading(false);
        });
    }, []);

    const handleEditClick = () => {
        setEditing(true);
    };

    const handleCancelClick = () => {
        setEditing(false);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = () => {
        const token = localStorage.getItem("token");

        axios.put('http://127.0.0.1:8000/api/paciente/update', formData, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json'
            }
        })
        .then(response => {
            axios.get('http://127.0.0.1:8000/api/paciente/data', {
                headers: {
                    Authorization: `Bearer ${token}`,
                    Accept: 'application/json'
                }
            })
            .then(response => {
                setPaciente(response.data.paciente);
                setEditing(false);
                setSuccessMessage("Datos actualizados correctamente.");
            })
            .catch(error => {
                console.error('Error al obtener los datos actualizados del paciente:', error);
                setError('No se pudieron cargar los datos actualizados del paciente.');
            });
        })
        .catch(error => {
            console.error('Error al actualizar los datos del paciente:', error);
            setError('No se pudieron actualizar los datos del paciente.');
        });
    };

    if (loading) {
        return <div className={styles.loadingMessage}>Cargando...</div>;
    }

    if (error) {
        return <div className={styles.errorMessage}>{error}</div>;
    }

    return (
        <div className={styles.profilePage}>
                <nav className={styles['top-bar']}>
                                  <div className={styles['logo-container']}>
                                    <img src="../img/logo.png" alt="Logo" className={styles.logo} />
                                    <p className={styles['mediconnect-text']}>MEDICONNECT</p>
                                  </div>
                          
                                
                                
                                </nav>
            <div className={styles.profileContainer}>
                {successMessage && <div className={styles.successMessage}>{successMessage}</div>}
                {paciente ? (
                    <div>
                        <h2>Perfil de {paciente.nombre} {paciente.ap_paterno} {paciente.ap_materno}</h2>
                        {editing ? (
                            <form>
                                <p><strong>Nombre:</strong> <input type="text" name="nombre" value={formData.nombre} onChange={handleChange} /></p>
                                <p><strong>Apellido Paterno:</strong> <input type="text" name="ap_paterno" value={formData.ap_paterno} onChange={handleChange} /></p>
                                <p><strong>Apellido Materno:</strong> <input type="text" name="ap_materno" value={formData.ap_materno} onChange={handleChange} /></p>
                                <p><strong>Teléfono:</strong> <input type="text" name="telefono" value={formData.telefono} onChange={handleChange} /></p>
                                <p><strong>Correo:</strong> <input type="email" name="email" value={formData.email} onChange={handleChange} /></p>
                                <button type="button" className={`${styles.profileButton} ${styles.primary}`} onClick={handleSubmit}>Guardar cambios</button>
                                <button type="button" className={`${styles.profileButton} ${styles.cancel}`} onClick={handleCancelClick}>Cancelar</button>
                            </form>
                        ) : (
                            <div>
                                <p><strong>Nombre:</strong> {paciente.nombre}</p>
                                <p><strong>Apellido Paterno:</strong> {paciente.ap_paterno}</p>
                                <p><strong>Apellido Materno:</strong> {paciente.ap_materno}</p>
                                <p><strong>Teléfono:</strong> {paciente.telefono}</p>
                                <p><strong>Correo:</strong> {paciente.email}</p>
                                <button type="button" className={`${styles.profileButton} ${styles.primary}`} onClick={handleEditClick}>Editar</button>
                            </div>
                        )}
                    </div>
                ) : (
                    <p>No se encontraron datos del paciente.</p>
                )}
            </div>
        </div>
    );
};

export default Profile;