import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

function App() {
    const [vehicules, setVehicules] = useState([]);
    const [recherche, setRecherche] = useState('');

    const [vehiculeId, setVehiculeId] = useState('');
    const [date, setDate] = useState('');
    const [duree, setDuree] = useState('');
    const [objet, setObjet] = useState('');

    const [chargement, setChargement] = useState(true);
    const [erreur, setErreur] = useState('');
    const [message, setMessage] = useState('');

    useEffect(() => {
        axios.get('/api/vehicules')
            .then((response) => {
                setVehicules(response.data);
                setChargement(false);
            })
            .catch(() => {
                setErreur('Impossible de charger les véhicules.');
                setChargement(false);
            });
    }, []);

    const vehiculesFiltres = vehicules.filter((vehicule) => {
        const texte = recherche.toLowerCase();

        return (
            vehicule.immatriculation?.toLowerCase().includes(texte) ||
            vehicule.marque?.toLowerCase().includes(texte) ||
            vehicule.modele?.toLowerCase().includes(texte)
        );
    });

    const creerReparation = (e) => {
        e.preventDefault();

        setMessage('');
        setErreur('');

        if (!vehiculeId || !date || !duree || !objet) {
            setErreur('Veuillez remplir tous les champs.');
            return;
        }

        axios.post('/api/reparations', {
            vehicule_id: vehiculeId,
            date: date,
            duree_main_oeuvre: duree,
            objet_reparation: objet
        })
            .then(() => {
                setMessage('Réparation créée avec succès.');

                setVehiculeId('');
                setDate('');
                setDuree('');
                setObjet('');
            })
            .catch((error) => {
                if (error.response?.data?.message) {
                    setErreur(error.response.data.message);
                } else {
                    setErreur('Erreur lors de la création de la réparation.');
                }
            });
    };

    return (
        <div style={{ padding: '30px', fontFamily: 'Arial' }}>

            <h1>Mini Garage</h1>

            <hr />

            <h2>Créer une réparation</h2>

            <form onSubmit={creerReparation}>

                <div style={{ marginBottom: '10px' }}>
                    <label>Véhicule : </label>

                    <select
                        value={vehiculeId}
                        onChange={(e) => setVehiculeId(e.target.value)}
                    >
                        <option value="">
                            -- Sélectionner un véhicule --
                        </option>

                        {vehicules.map((vehicule) => (
                            <option
                                key={vehicule.id}
                                value={vehicule.id}
                            >
                                {vehicule.immatriculation} - {vehicule.marque} {vehicule.modele}
                            </option>
                        ))}
                    </select>
                </div>

                <div style={{ marginBottom: '10px' }}>
                    <label>Date : </label>

                    <input
                        type="date"
                        value={date}
                        onChange={(e) => setDate(e.target.value)}
                    />
                </div>

                <div style={{ marginBottom: '10px' }}>
                    <label>Durée main d'œuvre : </label>

                    <input
                        type="number"
                        min="1"
                        value={duree}
                        onChange={(e) => setDuree(e.target.value)}
                    />
                </div>

                <div style={{ marginBottom: '10px' }}>
                    <label>Objet de la réparation : </label>

                    <input
                        type="text"
                        value={objet}
                        onChange={(e) => setObjet(e.target.value)}
                        placeholder="Exemple : Vidange"
                    />
                </div>

                <button type="submit">
                    Créer la réparation
                </button>

            </form>

            {message && (
                <p id="message-succes">
                    {message}
                </p>
            )}

            {erreur && (
                <p id="message-erreur">
                    {erreur}
                </p>
            )}

            <hr />

            <h2>Liste des véhicules</h2>

            <input
                id="recherche-vehicule"
                type="text"
                placeholder="Rechercher par immatriculation, marque ou modèle"
                value={recherche}
                onChange={(e) => setRecherche(e.target.value)}
                style={{
                    width: '400px',
                    padding: '10px',
                    marginBottom: '15px'
                }}
            />

            <div style={{ marginBottom: '15px' }}>

                <button
                    id="filtre-toyota"
                    type="button"
                    onClick={() => setRecherche('Toyota')}
                >
                    Filtrer Toyota
                </button>

                <button
                    id="filtre-tous"
                    type="button"
                    onClick={() => setRecherche('')}
                    style={{ marginLeft: '10px' }}
                >
                    Afficher tous
                </button>

            </div>

            {recherche && (
                <p id="filtre-actif">
                    Filtre appliqué : {recherche}
                </p>
            )}

            {chargement && (
                <p>Chargement des véhicules...</p>
            )}

            {!chargement && !erreur && (
                <>
                    <p id="nombre-resultats">
                        <strong>{vehiculesFiltres.length}</strong> véhicule(s) trouvé(s).
                    </p>

                    <table
                        border="1"
                        cellPadding="10"
                        cellSpacing="0"
                    >
                        <thead>
                            <tr>
                                <th>Immatriculation</th>
                                <th>Marque</th>
                                <th>Modèle</th>
                                <th>Année</th>
                                <th>Kilométrage</th>
                                <th>Énergie</th>
                                <th>Boîte</th>
                            </tr>
                        </thead>

                        <tbody>
                            {vehiculesFiltres.map((vehicule) => (
                                <tr key={vehicule.id}>

                                    <td>
                                        {vehicule.immatriculation}
                                    </td>

                                    <td>
                                        {vehicule.marque}
                                    </td>

                                    <td>
                                        {vehicule.modele}
                                    </td>

                                    <td>
                                        {vehicule.annee}
                                    </td>

                                    <td>
                                        {vehicule.kilometrage} km
                                    </td>

                                    <td>
                                        {vehicule.energie}
                                    </td>

                                    <td>
                                        {vehicule.boite}
                                    </td>

                                </tr>
                            ))}
                        </tbody>

                    </table>
                </>
            )}

        </div>
    );
}

createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);