<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\PerfilAlumno;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    
    // --- NUEVOS CAMPOS DEL PERFIL ---
    public $matricula;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $id_carrera;
    // --------------------------------

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'El nombre de usuario es obligatorio.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'El correo es obligatorio.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya está registrado.'],

            ['password', 'required', 'message' => 'La contraseña es obligatoria.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            
            // --- REGLAS DE TUS NUEVOS CAMPOS ---
            [['matricula', 'nombre', 'apellido_paterno', 'id_carrera'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['apellido_materno'], 'safe'],
            [['id_carrera'], 'integer'],
            [['matricula'], 'string', 'max' => 20],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 100],
            // -----------------------------------
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        // Iniciamos una transacción por seguridad
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            // 1. Guardamos el Usuario de Yii2 (Tabla 'user')
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = 10;
            
            // Si el usuario se guarda correctamente...
            if ($user->save()) {
                
                // 2. Guardamos el Perfil del Alumno (Tabla 'perfil_alumno')
                $perfil = new PerfilAlumno();
                $perfil->id_usuario = $user->id;
                $perfil->matricula = $this->matricula;
                $perfil->nombre = $this->nombre;
                $perfil->apellido_paterno = $this->apellido_paterno;
                $perfil->apellido_materno = $this->apellido_materno;
                $perfil->id_carrera = $this->id_carrera;
                
                if ($perfil->save()) {
                    $transaction->commit(); // Todo salió bien
                    return $this->sendEmail($user); // Enviamos el correo
                } else {
                    // Trampa 1: Atrapa los errores del modelo PerfilAlumno
                    $this->addErrors($perfil->getErrors());
                }

            } else {
                // Trampa 2: Atrapa los errores del modelo User
                $this->addErrors($user->getErrors());
            }
            
            // Si llega a este punto es porque algo falló en los save(), deshacemos los cambios
            $transaction->rollBack();
            return null;
            
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}