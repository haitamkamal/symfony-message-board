<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class CreateNewMessageController extends AbstractController
{
    private const MESSAGES_FILE = __DIR__ . '/../../var/messages.json';

    #[Route('/create/new/message', name: 'create_new_message', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $user = $request->request->get('user');
            $text = $request->request->get('text');

            // Create a new message
            $message = [
                'user' => htmlspecialchars($user),
                'text' => htmlspecialchars($text),
            ];

            // Load existing messages from the file
            $messages = [];
            if (file_exists(self::MESSAGES_FILE)) {
                $messages = json_decode(file_get_contents(self::MESSAGES_FILE), true);
            }

            // Add the new message to the array
            $messages[] = $message;

            // Save the updated messages back to the file
            file_put_contents(self::MESSAGES_FILE, json_encode($messages));

            // Redirect to the home page to see the updated messages
            return $this->redirectToRoute('home');
        }

        return $this->render('create_new_message/index.html.twig');
    }

    public static function getMessages(): array
    {
        if (file_exists(self::MESSAGES_FILE)) {
            return json_decode(file_get_contents(self::MESSAGES_FILE), true);
        }
        return [];
    }
}