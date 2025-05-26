import React from 'react';
import { BrowserRouter, Route, Routes, Navigate } from 'react-router-dom';
import { UserProvider } from './componets/UserContext'; // Asegúrate de importar el UserProvider
import Login from './componets/login';
import Home from './componets/home';
import Especialidad from './componets/especialidad';
import Cita from './componets/cita';
import Register from './componets/register';
import Doctor from './componets/doctor';
import Bien from './componets/bien';
import SobreNosotros from './componets/sobrenosotros';
import Politica from './componets/politica';
import Terminos from './componets/terminos';
import Consultarcitas from './componets/Consultarcitas'; 
import Profile from './componets/Profile';  
import CitasAtendidas from './componets/CitasAtendidas';  
import VerReceta from './componets/VerReceta';
import ProtectedRoute from './componets/ProtectedRoute';  // Importa el componente ProtectedRoute

function App() {
  return (
    <UserProvider>  {/* Envolver las rutas con UserProvider */}
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Navigate to="/bien" />} />
          <Route path="/bien" element={<Bien />} />
          <Route path="/login" element={<Login />} />
          <Route element={<ProtectedRoute />}>
            <Route path="/home" element={<Home />} />
          </Route>
          <Route path="/especialidad/:id?" element={<Especialidad />} />
          <Route path="/cita" element={<Cita />} />
          <Route path="/register" element={<Register />} />
          <Route path="/doctor" element={<Doctor />} />
          <Route path="*" element={<Home />} /> {/* Ruta para manejar páginas no encontradas */}
          <Route path="/sobrenosotros" element={<SobreNosotros />} />
          <Route path="/politica" element={<Politica />} />
          <Route path="/terminos" element={<Terminos />} />
          <Route path="/consultarcitas" element={<Consultarcitas/>} />
          <Route path="/profile" element={<Profile />} />
          <Route path="/citasatendidas" element={<CitasAtendidas />} />
          <Route path="/ver-receta/:id" element={<VerReceta />} /> {/* Ruta para ver receta */}
        </Routes>
      </BrowserRouter>
    </UserProvider>
  );
}

export default App;