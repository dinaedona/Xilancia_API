<?php

namespace App\Models\User;
use App\Utils\Parser;
use Illuminate\Validation\ValidationException;

class User
{
    public function __construct(
        private readonly Name $firstName,
        private readonly Name $lastName,
        private readonly Email $email,
        private readonly ?UserId $id = null
    ) {
    }

    /**
     * @throws ValidationException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            Name::fromString(Parser::parseString($data, 'first_name')),
            Name::fromString(Parser::parseString($data, 'last_name')),
            Email::fromString(Parser::parseString($data, 'email')),
            UserId::fromNullableInt(Parser::parseNullableInt($data, 'id'))
        );
    }

    /**
     * @throws ValidationException
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            Name::fromString(Parser::parseString($data, 'first_name')),
            Name::fromString(Parser::parseString($data, 'last_name')),
            Email::fromString(Parser::parseString($data, 'email'), true),
            UserId::fromNullableInt(Parser::parseNullableInt($data, 'id'))
        );
    }

    // Getters
    public function getId(): ?UserId
    {
        return $this->id;
    }

    public function getFirstName(): Name
    {
        return $this->firstName;
    }

    public function getLastName(): Name
    {
        return $this->lastName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id->asInt(),
            'first_name' => $this->firstName->asString(),
            'last_name' => $this->lastName->asString(),
            'email' => $this->email->asString()
        ];
    }
}
